/**
 * Editor copy of resources/views/partials/feature-visual.blade.php.
 */
const Grip = () => (
  <span className="grid grid-cols-2 gap-[3px] opacity-40">
    {[...Array(6)].map((_, index) => (
      <span key={index} className="size-[3px] rounded-full bg-current" />
    ))}
  </span>
);

const Menu = () => (
  <div className="flex flex-col gap-2.5 text-[15px] text-ink">
    {["Dashboard", "Orders"].map((label) => (
      <span key={label} className="flex items-center gap-3 rounded-xl bg-mist px-4 py-3">
        <Grip />
        {label}
      </span>
    ))}
    <span className="ml-10 flex -rotate-2 items-center gap-3 rounded-xl bg-brand px-4 py-3 text-white shadow-[0_16px_28px_-14px_rgba(6,47,63,0.6)]">
      <Grip />
      Refunds
      <span className="ml-auto rounded-full bg-white/20 px-2.5 py-1 text-xs">Level 2</span>
    </span>
    <span className="flex items-center gap-3 rounded-xl bg-mist px-4 py-3">
      <Grip />
      Products
      <span className="ml-auto rounded-full bg-white px-2.5 py-1 text-xs">Hidden for Editors</span>
    </span>
  </div>
);

const Toolbar = () => (
  <div className="flex flex-col gap-2.5 text-[15px] text-white">
    <span className="pb-1 text-xs text-ice/80">Toolbar items</span>
    {[
      ["Site name", true],
      ["Account", true],
      ["SEO plugin badge", false],
      ["Cache plugin badge", false],
    ].map(([label, on]) => (
      <span
        key={label}
        className={`flex items-center justify-between gap-3 rounded-xl bg-white/10 px-4 py-3.5 ${on ? "" : "text-white/60"}`}
      >
        {label}
        <span
          className={`flex h-6 w-11 flex-none rounded-full p-1 ${on ? "justify-end bg-sun" : "bg-white/20"}`}
        >
          <span className={`size-4 rounded-full ${on ? "bg-ink" : "bg-white"}`} />
        </span>
      </span>
    ))}
  </div>
);

const Columns = () => (
  <div className="flex flex-col gap-4 text-sm text-ink">
    <div className="flex flex-wrap items-center gap-2">
      <span className="rounded-full bg-mist px-3.5 py-2">Image</span>
      <span className="rounded-full bg-mist px-3.5 py-2">Title</span>
      <span className="-rotate-3 rounded-full bg-brand px-3.5 py-2 text-white shadow-[0_10px_20px_-10px_rgba(6,47,63,0.6)]">
        ACF: Season ↓
      </span>
      <span className="rounded-full bg-mist px-3.5 py-2">Modified</span>
      <span className="rounded-full border border-dashed border-ink-soft/40 px-3.5 py-2 text-ink-soft line-through">
        Tags
      </span>
    </div>
    {[1, 2, 3].map((row) => (
      <span key={row} className="flex items-center gap-3">
        <span className="size-10 flex-none rounded-xl bg-mist" />
        <span className="h-2 flex-[2] rounded-full bg-mist" />
        <span className="h-2 flex-1 rounded-full bg-frost" />
        <span className="h-2 flex-1 rounded-full bg-mist" />
      </span>
    ))}
  </div>
);

const Handover = () => (
  <div className="flex flex-wrap items-center justify-center gap-5 text-ink">
    <div className="flex w-[min(280px,100%)] flex-col gap-3 rounded-2xl bg-white p-5 shadow-[0_24px_40px_-24px_rgba(6,47,63,0.6)]">
      <span className="mx-auto mb-1 size-10 rounded-xl bg-sun" />
      <span className="h-9 rounded-lg border border-line" />
      <span className="h-9 rounded-lg border border-line" />
      <span className="rounded-full bg-ink py-2.5 text-center text-sm font-bold text-white">
        Log in
      </span>
      <span className="text-center text-xs text-ink-soft">Need an account? Email us</span>
    </div>
    <div className="flex flex-col items-center gap-2.5 text-sm font-bold md:items-start">
      <span className="rounded-full bg-white px-4 py-2.5">Maintenance page</span>
      <span className="rounded-full bg-white px-4 py-2.5">Open Graph cards</span>
      <span className="rounded-full bg-sun px-4 py-2.5">GA4 dashboard</span>
    </div>
  </div>
);

const visuals = { menu: Menu, toolbar: Toolbar, columns: Columns, handover: Handover };

export const Visual = ({ visual }) => {
  const Component = visuals[visual] ?? Menu;

  return (
    <div className="w-full text-left" aria-hidden="true">
      <Component />
    </div>
  );
};
