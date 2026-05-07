import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
  connect() {
    this.applyTheme(this.currentTheme())
  }

  toggle() {
    const nextTheme = this.currentTheme() === "dark" ? "light" : "dark"

    localStorage.setItem("theme", nextTheme)
    this.applyTheme(nextTheme)
  }

  currentTheme() {
    const savedTheme = localStorage.getItem("theme")
    if (savedTheme === "light" || savedTheme === "dark") {
      return savedTheme
    }

    return window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"
  }

  applyTheme(theme) {
    document.documentElement.classList.toggle("dark", theme === "dark")
  }
}
