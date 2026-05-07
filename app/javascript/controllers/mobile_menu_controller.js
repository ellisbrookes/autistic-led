import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
  static targets = ["menu", "button"]

  toggle() {
    this.menuTarget.classList.toggle("hidden")
    this.buttonTarget.setAttribute("aria-expanded", this.open ? "true" : "false")
  }

  get open() {
    return !this.menuTarget.classList.contains("hidden")
  }
}
