import { Controller } from "@hotwired/stimulus"

// The homepage contact form isn't wired up to send email yet, so this just
// swaps in a confirmation message on submit. Replace with a real Turbo
// submission once a ContactsController/mailer exists.
export default class extends Controller {
  static targets = ["form", "confirmation"]

  submit(event) {
    event.preventDefault()
    this.formTarget.hidden = true
    this.confirmationTarget.hidden = false
    this.confirmationTarget.focus()
  }

  reset() {
    this.formTarget.reset()
    this.formTarget.hidden = false
    this.confirmationTarget.hidden = true
  }
}
