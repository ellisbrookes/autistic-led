import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
  static values = {
    delay: { type: Number, default: 3000 }
  }

  connect() {
    this.timeout = setTimeout(() => {
      this.element.classList.add("opacity-0")

      setTimeout(() => {
        this.element.remove()
      }, 700)
    }, this.delayValue)
  }

  disconnect() {
    clearTimeout(this.timeout)
  }
}
