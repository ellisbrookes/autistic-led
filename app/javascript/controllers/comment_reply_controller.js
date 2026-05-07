import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
  static targets = ["title", "form", "cancel", "submit", "body", "counter"]
  static values = { defaultUrl: String }

  static MAX_LENGTH = 1000
  static WARNING_THRESHOLD = 900
  static DANGER_THRESHOLD = 980

  connect() {
    this.updateCounter()
  }

  reply(event) {
    event.preventDefault()

    const { url, name } = event.params
    this.formTarget.setAttribute("action", url)
    this.titleTarget.textContent = `Replying to ${name}`
    this.submitTarget.value = "Post reply"
    this.cancelTarget.classList.remove("hidden")
    this.formTarget.scrollIntoView({ behavior: "smooth", block: "center" })
    this.bodyTarget.focus()
  }

  cancel(event) {
    event.preventDefault()

    this.formTarget.setAttribute("action", this.defaultUrlValue)
    this.titleTarget.textContent = "Write a comment"
    this.submitTarget.value = "Post comment"
    this.cancelTarget.classList.add("hidden")
  }

  updateCounter() {
    if (!this.hasCounterTarget || !this.hasBodyTarget) return

    const currentLength = this.bodyTarget.value.length
    this.counterTarget.textContent = `${currentLength}/${this.constructor.MAX_LENGTH}`

    this.counterTarget.classList.remove("warning", "danger")

    if (currentLength >= this.constructor.DANGER_THRESHOLD) {
      this.counterTarget.classList.add("danger")
    } else if (currentLength >= this.constructor.WARNING_THRESHOLD) {
      this.counterTarget.classList.add("warning")
    }
  }
}
