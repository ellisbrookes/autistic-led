import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
  static targets = ["postcodeInput", "addressInput", "status"]

  async lookup(event) {
    event.preventDefault()

    if (!this.hasPostcodeInputTarget || !this.hasAddressInputTarget || !this.hasStatusTarget) return

    const postcode = this.postcodeInputTarget.value.trim()
    if (postcode.length === 0) {
      this.statusTarget.textContent = "Enter a postcode to look up an address."
      return
    }

    this.statusTarget.textContent = "Looking up postcode..."

    try {
      const response = await fetch(`https://api.postcodes.io/postcodes/${encodeURIComponent(postcode)}`)
      if (!response.ok) {
        throw new Error("Lookup request failed")
      }

      const data = await response.json()
      if (data.status !== 200 || !data.result) {
        throw new Error("Postcode not found")
      }

      const result = data.result
      const address = this.buildAddress(result)
      this.addressInputTarget.value = address
      this.addressInputTarget.dispatchEvent(new Event("input", { bubbles: true }))
      this.addressInputTarget.dispatchEvent(new Event("change", { bubbles: true }))
      this.statusTarget.textContent = `Address filled from ${result.postcode}.`
    } catch (_error) {
      this.statusTarget.textContent = "We could not find that postcode. Please check and try again."
    }
  }

  buildAddress(result) {
    const parts = [
      result.postcode,
      result.admin_ward,
      result.admin_district,
      result.region
    ]

    const uniqueParts = []
    for (const part of parts) {
      if (!part) continue
      if (uniqueParts.includes(part)) continue
      uniqueParts.push(part)
    }

    return uniqueParts.join(", ")
  }
}
