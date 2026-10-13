import { __ } from "@wordpress/i18n";
import { Icon, chevronLeft, chevronRight, plus, trash } from "@wordpress/icons";

/**
 * Helpers for array attributes (cards, rows, plans…). Items can be objects or strings.
 */
export const useItems = (items, setItems) => ({
  update: (index, patch) =>
    setItems(
      items.map((item, i) =>
        i !== index ? item : typeof item === "object" ? { ...item, ...patch } : patch,
      ),
    ),
  remove: (index) => setItems(items.filter((_, i) => i !== index)),
  move: (index, offset) => {
    const next = [...items];
    next.splice(index + offset, 0, ...next.splice(index, 1));
    setItems(next);
  },
  add: (item) => setItems([...items, item]),
});

const controlClass =
  "flex size-8 cursor-pointer items-center justify-center rounded-full border-0 bg-transparent text-ink hover:bg-sky disabled:cursor-default disabled:opacity-30";

/**
 * Floating move / remove toolbar for one item. Place inside a `relative` element.
 */
export const ItemControls = ({ index, count, actions, show }) =>
  show ? (
    <div
      contentEditable={false}
      className="absolute -top-4 right-4 z-10 flex rounded-full bg-white p-0.5 shadow-md ring-1 ring-line"
    >
      <button
        type="button"
        className={controlClass}
        disabled={index === 0}
        onClick={() => actions.move(index, -1)}
        aria-label={__("Move back", "radicle")}
      >
        <Icon icon={chevronLeft} size={20} />
      </button>
      <button
        type="button"
        className={controlClass}
        disabled={index === count - 1}
        onClick={() => actions.move(index, 1)}
        aria-label={__("Move forward", "radicle")}
      >
        <Icon icon={chevronRight} size={20} />
      </button>
      <button
        type="button"
        className={`${controlClass} text-[#b42318]`}
        onClick={() => actions.remove(index)}
        aria-label={__("Remove", "radicle")}
      >
        <Icon icon={trash} size={20} />
      </button>
    </div>
  ) : null;

/**
 * Dashed "add" button shown while the block is selected.
 */
export const AddItem = ({ show, onClick, label, className = "" }) =>
  show ? (
    <button
      type="button"
      onClick={onClick}
      className={`flex min-h-12 cursor-pointer items-center justify-center gap-1 rounded-[28px] border-2 border-dashed border-current/30 bg-transparent px-5 font-sans text-[15px] font-bold text-current opacity-70 hover:opacity-100 ${className}`}
    >
      <Icon icon={plus} size={20} fill="currentColor" />
      {label}
    </button>
  ) : null;
