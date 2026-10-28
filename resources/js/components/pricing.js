/**
 * Pricing block: the Yearly / Lifetime toggle and the plan buttons. A button
 * with licences opens the Freemius checkout as an overlay; its href is the
 * same checkout as a page, used when the overlay can't load (and for
 * middle-click).
 */
export default ({ productId, publicKey, planId }) => ({
  lifetime: false,
  checkout: null,

  cycle() {
    return this.lifetime ? "lifetime" : "annual";
  },

  url(licenses) {
    const params = new URLSearchParams({ licenses, billing_cycle: this.cycle() });

    return `https://checkout.freemius.com/plugin/${productId}/plan/${planId}/?${params}`;
  },

  async buy(event, licenses) {
    if (event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey) return;
    event.preventDefault();

    try {
      if (!this.checkout) {
        const { Checkout } = await import("@freemius/checkout");
        this.checkout = new Checkout({ product_id: productId, public_key: publicKey });
      }

      await this.checkout.open({
        plan_id: planId,
        licenses: licenses === "unlimited" ? "unlimited" : Number(licenses),
        billing_cycle: this.cycle(),
      });
    } catch {
      window.location.href = this.url(licenses);
    }
  },
});
