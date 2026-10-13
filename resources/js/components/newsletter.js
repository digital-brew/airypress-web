/**
 * Footer newsletter form: subscribes an email to a Klaviyo list
 * through Klaviyo's public client API (no secret key involved).
 */
export default ({ publicKey, listId }) => ({
  email: "",
  status: "idle",

  async submit() {
    this.status = "loading";

    try {
      const response = await fetch(
        `https://a.klaviyo.com/client/subscriptions?company_id=${encodeURIComponent(publicKey)}`,
        {
          method: "POST",
          headers: {
            "content-type": "application/vnd.api+json",
            revision: "2026-04-15",
          },
          body: JSON.stringify({
            data: {
              type: "subscription",
              attributes: {
                profile: { data: { type: "profile", attributes: { email: this.email } } },
              },
              relationships: { list: { data: { type: "list", id: listId } } },
            },
          }),
        },
      );

      this.status = response.ok ? "success" : "error";
    } catch {
      this.status = "error";
    }
  },
});
