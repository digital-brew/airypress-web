/**
 * Editor copy of resources/views/partials/hero-mockup.blade.php.
 */
export const Mockup = ({ frame }) => (
  <div className={frame} aria-hidden="true">
    <div className="flex min-h-[380px] gap-2.5 rounded-3xl bg-mist p-2.5 text-ink">
      <div className="flex w-[150px] flex-none flex-col gap-1 px-1 py-2 text-[13px] text-ink-soft max-sm:hidden">
        <div className="flex items-center gap-2 px-2 pt-1 pb-3.5 font-bold text-ink">
          <span className="size-5 rounded-[7px] bg-brand" />
          Client Co.
        </div>
        <span className="rounded-xl bg-white px-3 py-2 font-bold text-ink">Dashboard</span>
        {["Orders", "Products", "Pages", "Customers"].map((label) => (
          <span key={label} className="px-3 py-2">
            {label}
          </span>
        ))}
      </div>
      <div className="flex min-w-0 flex-1 flex-col gap-3.5 rounded-[18px] bg-white p-[18px]">
        <div className="flex items-center justify-between gap-2">
          <span className="text-base font-bold">Dashboard</span>
          <span className="rounded-full bg-brand px-3.5 py-1.5 text-xs font-bold text-white">
            Add product
          </span>
        </div>
        <div className="flex flex-col gap-2.5 rounded-2xl bg-mist p-3.5">
          <span className="text-xs font-medium text-ink-soft">Site analytics</span>
          <div className="flex h-[90px] items-end gap-1.5">
            {[35, 50, 42, 66, 58].map((height) => (
              <span
                key={height}
                className="flex-1 rounded-lg bg-frost"
                style={{ height: `${height}%` }}
              />
            ))}
            <span className="h-[90%] flex-1 rounded-lg bg-brand" />
          </div>
        </div>
        <div className="grid flex-1 grid-cols-2 gap-2.5">
          <div className="rounded-2xl border border-line" />
          <div className="rounded-2xl border border-line" />
        </div>
      </div>
    </div>
  </div>
);
