import { InspectorControls, useBlockProps } from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";
import { Icon, close } from "@wordpress/icons";
import { Anchor } from "../../components/Anchor";
import { ColorPanels, colorVariables } from "../../components/Colors";
import { AddItem, ItemControls, useItems } from "../../components/Items";
import { Text } from "../../components/Text";
import colorGroups from "./colors";

const removeClass =
  "absolute -top-2 -right-2 flex size-6 cursor-pointer items-center justify-center rounded-full border-0 bg-white text-[#b42318] shadow ring-1 ring-line";

export default function Edit({ attributes, setAttributes, isSelected }) {
  const props = useBlockProps({ style: colorVariables(attributes.colors) });
  const { columns, rows, chips, tested } = attributes;
  const rowActions = useItems(rows, (rows) => setAttributes({ rows }));
  const chipActions = useItems(chips, (chips) => setAttributes({ chips }));
  const testedActions = useItems(tested, (tested) => setAttributes({ tested }));

  const setColumn = (index, value) =>
    setAttributes({ columns: columns.map((column, i) => (i === index ? value : column)) });
  const addColumn = () =>
    setAttributes({
      columns: [...columns, ""],
      rows: rows.map((row) => ({ ...row, values: [...(row.values || []), ""] })),
    });
  const removeColumn = (index) =>
    setAttributes({
      columns: columns.filter((_, i) => i !== index),
      rows: rows.map((row) => ({
        ...row,
        values: (row.values || []).filter((_, i) => i !== index),
      })),
    });
  const setCell = (rowIndex, columnIndex, value) => {
    const values = [...(rows[rowIndex].values || [])];
    values[columnIndex] = value;
    rowActions.update(rowIndex, { values });
  };

  return (
    <>
      <InspectorControls group="styles">
        <ColorPanels
          colors={attributes.colors}
          onChange={(colors) => setAttributes({ colors })}
          groups={colorGroups}
        />
      </InspectorControls>
      <Anchor value={attributes.anchor} onChange={(anchor) => setAttributes({ anchor })} />
      <section {...props}>
        <div className="bg-[var(--c-bg,var(--color-sky))] px-[clamp(16px,4vw,56px)] py-[clamp(40px,6vw,96px)]">
          <div className="mx-auto flex max-w-[1100px] flex-col gap-10">
            <Text
              tagName="h2"
              className="section-title text-center text-[var(--c-heading,var(--color-ink))]"
              placeholder={__("Heading", "radicle")}
              value={attributes.heading}
              onChange={(heading) => setAttributes({ heading })}
            />

            <div className="overflow-x-auto rounded-[32px] bg-[var(--c-table-bg,var(--color-white))] p-3">
              <table className="w-full min-w-[640px] border-separate border-spacing-0 text-base">
                <thead>
                  <tr>
                    <th className="p-5" />
                    {columns.map((column, index) => (
                      <th
                        key={index}
                        className={`relative p-5 ${index === 0 ? "rounded-t-[22px] bg-[var(--c-highlight-bg,var(--color-brand))] font-display text-xl font-extrabold text-[var(--c-highlight-text,var(--color-white))]" : "font-bold"}`}
                      >
                        <Text
                          plain
                          tagName="span"
                          placeholder={
                            index === 0
                              ? __("Your product", "radicle")
                              : __("Competitor", "radicle")
                          }
                          value={column}
                          onChange={(value) => setColumn(index, value)}
                        />
                        {isSelected && (
                          <button
                            type="button"
                            className={removeClass}
                            onClick={() => removeColumn(index)}
                            aria-label={__("Remove column", "radicle")}
                          >
                            <Icon icon={close} size={16} />
                          </button>
                        )}
                      </th>
                    ))}
                    {isSelected && (
                      <th className="w-0 p-2">
                        <AddItem
                          onClick={addColumn}
                          show
                          label={__("Column", "radicle")}
                          className="min-h-10"
                        />
                      </th>
                    )}
                  </tr>
                </thead>
                <tbody>
                  {rows.map((row, rowIndex) => (
                    <tr key={rowIndex}>
                      <th
                        scope="row"
                        className="relative border-t border-[var(--c-line,var(--color-line))] px-5 py-[18px] text-left font-normal text-[var(--c-label-text,var(--color-ink))]"
                      >
                        <ItemControls
                          index={rowIndex}
                          count={rows.length}
                          actions={rowActions}
                          show={isSelected}
                        />
                        <Text
                          plain
                          tagName="span"
                          placeholder={__("Feature", "radicle")}
                          value={row.label}
                          onChange={(label) => rowActions.update(rowIndex, { label })}
                        />
                      </th>
                      {columns.map((_, columnIndex) => (
                        <td
                          key={columnIndex}
                          className={`px-5 py-[18px] text-center ${
                            columnIndex === 0
                              ? `bg-[var(--c-highlight-bg,var(--color-brand))] font-bold text-[var(--c-highlight-text,var(--color-white))] ${rowIndex === rows.length - 1 ? "rounded-b-[22px]" : ""}`
                              : "border-t border-[var(--c-line,var(--color-line))] text-[var(--c-cell-text,var(--color-ink-soft))]"
                          }`}
                        >
                          <Text
                            plain
                            tagName="span"
                            placeholder="—"
                            value={row.values?.[columnIndex] || ""}
                            onChange={(value) => setCell(rowIndex, columnIndex, value)}
                          />
                        </td>
                      ))}
                    </tr>
                  ))}
                </tbody>
              </table>
              <AddItem
                show={isSelected || !rows.length}
                onClick={() => rowActions.add({ label: "", values: columns.map(() => "") })}
                label={__("Add row", "radicle")}
                className="mt-3 w-full"
              />
            </div>

            <div className="flex flex-wrap justify-center gap-2.5">
              {chips.map((chip, index) => (
                <span
                  key={index}
                  className="relative rounded-full bg-[var(--c-chip-bg,var(--color-white))] px-[18px] py-2.5 text-[15px] font-medium text-[var(--c-chip-text,var(--color-ink))]"
                >
                  <Text
                    plain
                    tagName="span"
                    placeholder={__("Chip", "radicle")}
                    value={chip}
                    onChange={(value) => chipActions.update(index, value)}
                  />
                  {isSelected && (
                    <button
                      type="button"
                      className={removeClass}
                      onClick={() => chipActions.remove(index)}
                      aria-label={__("Remove", "radicle")}
                    >
                      <Icon icon={close} size={16} />
                    </button>
                  )}
                </span>
              ))}
              <AddItem
                show={isSelected}
                onClick={() => chipActions.add("")}
                label={__("Chip", "radicle")}
                className="min-h-10"
              />
            </div>

            <div className="flex flex-wrap items-center justify-center gap-x-7 gap-y-2.5 text-[15px] text-[var(--c-tested-text,var(--color-ink-soft))]">
              <Text
                plain
                tagName="span"
                className="font-bold text-[var(--c-tested-label,var(--color-ink))]"
                placeholder={__("Tested with", "radicle")}
                value={attributes.testedLabel}
                onChange={(testedLabel) => setAttributes({ testedLabel })}
              />
              {tested.map((name, index) => (
                <span key={index} className="relative">
                  <Text
                    plain
                    tagName="span"
                    placeholder={__("Plugin", "radicle")}
                    value={name}
                    onChange={(value) => testedActions.update(index, value)}
                  />
                  {isSelected && (
                    <button
                      type="button"
                      className={removeClass}
                      onClick={() => testedActions.remove(index)}
                      aria-label={__("Remove", "radicle")}
                    >
                      <Icon icon={close} size={16} />
                    </button>
                  )}
                </span>
              ))}
              <AddItem
                show={isSelected}
                onClick={() => testedActions.add("")}
                label={__("Name", "radicle")}
                className="min-h-10"
              />
            </div>
          </div>
        </div>
      </section>
    </>
  );
}
