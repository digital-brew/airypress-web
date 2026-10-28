/**
 * Editor copy of resources/views/partials/hero-mockup.blade.php.
 */
const Dot = ({ className = "bg-frost" }) => (
  <span className={`size-1.5 rounded-full ${className}`} />
);

export const Mockup = () => (
  <div
    className="flex min-h-[clamp(360px,48vw,630px)] gap-3 rounded-[1.25rem] bg-mist p-3 text-left text-ink"
    aria-hidden="true"
  >
    <div className="flex w-[220px] flex-none flex-col gap-1 py-3 text-[15px] text-ink-soft max-md:hidden">
      <div className="flex items-center gap-2.5 px-7 pb-5 font-bold text-ink">
        <span className="size-7 rounded-lg bg-brand" />
        Client Co.
      </div>
      <span className="flex items-center gap-3 rounded-2xl bg-white px-4 py-3 font-bold text-ink">
        <Dot className="bg-brand" />
        Dashboard
      </span>
      {["Orders", "Products", "Pages", "Customers"].map((label) => (
        <span key={label} className="flex items-center gap-3 px-4 py-3">
          <Dot />
          {label}
        </span>
      ))}
      <span className="mt-auto flex items-center gap-3 px-4 py-3">
        <Dot />
        Settings
      </span>
    </div>

    <div className="flex min-w-0 flex-1 flex-col gap-4 rounded-3xl bg-white p-[clamp(14px,2vw,26px)]">
      <div className="flex flex-wrap items-center justify-between gap-3">
        <span className="font-display text-[clamp(20px,2vw,26px)] font-extrabold tracking-[-0.02em]">
          Dashboard
        </span>
        <span className="flex gap-2 text-sm font-bold">
          <span className="rounded-full border border-line px-4 py-2.5 font-medium max-sm:hidden">
            View site
          </span>
          <span className="rounded-full bg-brand px-4 py-2.5 text-white">Add product</span>
        </span>
      </div>

      <div className="grid flex-1 grid-cols-[repeat(auto-fit,minmax(min(260px,100%),1fr))] gap-4 md:grid-cols-[1.7fr_1fr]">
        <div className="flex flex-col gap-4 rounded-2xl bg-mist p-5">
          <span className="flex justify-between gap-2 text-sm font-bold">
            Site analytics <span className="text-xs font-medium text-ink-soft">GA4 · 28 days</span>
          </span>
          <span className="flex h-[clamp(90px,10vw,140px)] items-end gap-2">
            {[31, 50, 41, 59, 54, 73, 67, 85].map((height, index) => (
              <span
                key={index}
                className="flex-1 rounded-lg bg-frost"
                style={{ height: `${height}%` }}
              />
            ))}
            <span className="h-full flex-1 rounded-lg bg-brand" />
          </span>
        </div>

        <div className="flex flex-col gap-3 rounded-2xl bg-ink p-5 text-white">
          <span className="text-sm font-bold">Online now</span>
          <span className="flex items-center gap-2">
            <span className="size-2.5 rounded-full bg-sun" />
            <span className="h-2 w-3/5 rounded-full bg-white/25" />
          </span>
          <span className="h-2 w-1/2 rounded-full bg-white/25" />
          <span className="h-2 w-2/5 rounded-full bg-white/25" />
          <span className="mt-auto self-start rounded-full bg-white px-3.5 py-2 text-xs font-bold text-ink">
            Top pages
          </span>
        </div>

        <div className="flex flex-col gap-4 rounded-2xl border border-line p-5 max-sm:hidden">
          <span className="text-sm font-bold">Recent orders</span>
          {["Paid", "Pending", "Paid"].map((status, index) => (
            <span key={index} className="flex items-center gap-3">
              <span className="size-9 flex-none rounded-xl bg-mist" />
              <span className="h-2 flex-1 rounded-full bg-mist" />
              <span
                className={`rounded-full px-2.5 py-1 text-[11px] font-bold ${
                  status === "Paid" ? "bg-sky text-brand-dark" : "bg-sun/40 text-ink"
                }`}
              >
                {status}
              </span>
            </span>
          ))}
        </div>

        <div className="flex flex-col gap-3 rounded-2xl bg-sun p-5 max-sm:hidden">
          <span className="text-sm font-bold">Need a change?</span>
          <span className="h-2 w-4/5 rounded-full bg-ink/15" />
          <span className="h-2 w-3/5 rounded-full bg-ink/15" />
          <span className="mt-auto self-start rounded-full bg-ink px-3.5 py-2 text-xs font-bold text-white">
            Email your agency
          </span>
        </div>
      </div>
    </div>
  </div>
);
