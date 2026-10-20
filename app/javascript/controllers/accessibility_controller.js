import { Controller } from "@hotwired/stimulus"

// Drives the "Accessibility settings" panel in the footer: colour/contrast
// theme, text size, reading font, line/letter spacing, underlined links and
// reduced motion. Preferences persist in localStorage and are applied as
// data-a11y-* attributes on <html>, which app/assets/tailwind/application.css
// reads via CSS custom properties.
export default class extends Controller {
  static targets = ["panel", "toggleButton", "control", "liveRegion", "motionSensitive"]

  STORAGE_KEY = "autisticled.a11y"

  OFF_VALUES = {
    spacing: "normal",
    letters: "normal",
    underline: "false",
    motion: "no-preference"
  }

  connect() {
    this.state = this.loadState()
    this.render()
  }

  loadState() {
    let saved = {}

    try {
      saved = JSON.parse(localStorage.getItem(this.STORAGE_KEY)) || {}
    } catch (error) {
      saved = {}
    }

    const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches
    const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches

    return {
      theme: saved.theme || (prefersDark ? "dark" : "light"),
      size: saved.size || "medium",
      font: saved.font || "standard",
      spacing: saved.spacing || "normal",
      letters: saved.letters || "normal",
      underline: typeof saved.underline === "boolean" ? saved.underline : false,
      motion: saved.motion || (prefersReducedMotion ? "reduce" : "no-preference"),
      panelOpen: false
    }
  }

  persist() {
    const { panelOpen, ...toSave } = this.state
    localStorage.setItem(this.STORAGE_KEY, JSON.stringify(toSave))
  }

  // Always sets the given key to the given value. Used by the theme, text
  // size and reading font choices, which behave like a set of radio buttons.
  choose(event) {
    const { key, value } = event.params
    this.state[key] = value
    this.update()
  }

  // Flips the given key between its "on" value and its default/off value.
  // Used by the roomier-spacing, wider-letters, underline-links and
  // reduce-motion switches.
  toggleSwitch(event) {
    const { key, value } = event.params
    const offValue = this.OFF_VALUES[key]
    const isBoolean = value === "true"
    const currentlyOn = isBoolean ? this.state[key] === true : this.state[key] === value

    this.state[key] = currentlyOn ? (isBoolean ? false : offValue) : (isBoolean ? true : value)
    this.update()
  }

  togglePanel() {
    this.state.panelOpen = !this.state.panelOpen
    this.render()
  }

  reset() {
    this.state = {
      ...this.state,
      theme: "light",
      size: "medium",
      font: "standard",
      spacing: "normal",
      letters: "normal",
      underline: false,
      motion: "no-preference"
    }
    this.update()
  }

  update() {
    this.persist()
    this.render()
  }

  render() {
    const s = this.state
    const html = document.documentElement

    html.dataset.a11yTheme = s.theme
    html.classList.toggle("dark", s.theme === "dark")
    html.dataset.a11ySize = s.size
    html.dataset.a11yFont = s.font
    html.dataset.a11ySpacing = s.spacing
    html.dataset.a11yLetters = s.letters
    html.dataset.a11yUnderline = s.underline ? "true" : "false"
    html.dataset.a11yMotion = s.motion

    if (this.hasPanelTarget) {
      this.panelTarget.classList.toggle("hidden", !s.panelOpen)
    }

    if (this.hasToggleButtonTarget) {
      this.toggleButtonTarget.setAttribute("aria-expanded", s.panelOpen ? "true" : "false")
    }

    this.controlTargets.forEach((el) => {
      const key = el.dataset.accessibilityKeyParam
      const value = el.dataset.accessibilityValueParam
      if (!key || value === undefined) return

      const current = key === "underline" ? String(s.underline) : s[key]
      el.setAttribute("aria-pressed", String(current) === value ? "true" : "false")
    })

    if (this.hasLiveRegionTarget) {
      const themeLabels = { light: "Light", dark: "Dark", "high-contrast": "High contrast", calm: "Calm" }
      const fontNote = s.font === "dyslexia" ? ", dyslexia-friendly font" : ""
      this.liveRegionTarget.textContent = `${themeLabels[s.theme] || s.theme} theme, text size ${s.size}${fontNote}`
    }

    // Autoplaying video is exactly what "reduce motion" is meant to stop.
    this.motionSensitiveTargets.forEach((el) => {
      if (s.motion === "reduce") {
        el.pause()
      } else if (el.paused) {
        el.play().catch(() => {})
      }
    })
  }
}
