import {
  InspectorControls,
  MediaUpload,
  MediaUploadCheck,
  useBlockProps,
} from "@wordpress/block-editor";
import { Button, PanelBody } from "@wordpress/components";
import { store as coreStore } from "@wordpress/core-data";
import { useSelect } from "@wordpress/data";
import { __ } from "@wordpress/i18n";
import { Anchor } from "../../components/Anchor";
import { ColorPanels, colorVariables } from "../../components/Colors";
import colorGroups from "./colors";
import { Text } from "../../components/Text";
import { UrlField } from "../../components/UrlField";
import { Mockup } from "./mockup";

const frame = "rounded-[32px] bg-white p-3 shadow-[0_40px_80px_-30px_rgba(6,47,63,0.55)]";

export default function Edit({ attributes, setAttributes }) {
  const props = useBlockProps({
    className:
      "gutter overflow-hidden bg-[var(--c-bg,var(--color-brand))] pb-[clamp(40px,6vw,80px)] text-white",
    style: colorVariables(attributes.colors),
  });
  const media = useSelect(
    (select) => (attributes.mediaId ? select(coreStore).getMedia(attributes.mediaId) : null),
    [attributes.mediaId],
  );
  const field = (key) => ({
    value: attributes[key],
    onChange: (value) => setAttributes({ [key]: value }),
  });

  return (
    <>
      <InspectorControls group="styles">
        <ColorPanels
          colors={attributes.colors}
          onChange={(colors) => setAttributes({ colors })}
          groups={colorGroups}
        />
      </InspectorControls>
      <InspectorControls>
        <PanelBody title={__("Buttons", "radicle")}>
          <UrlField label={__("Primary button URL", "radicle")} {...field("primaryUrl")} />
          <UrlField label={__("Secondary button URL", "radicle")} {...field("secondaryUrl")} />
        </PanelBody>
        <PanelBody title={__("Product visual", "radicle")}>
          <MediaUploadCheck>
            <MediaUpload
              allowedTypes={["image"]}
              value={attributes.mediaId}
              onSelect={(image) => setAttributes({ mediaId: image.id, mediaAlt: image.alt || "" })}
              render={({ open }) => (
                <Button variant="secondary" onClick={open}>
                  {attributes.mediaId
                    ? __("Replace image", "radicle")
                    : __("Use an image instead of the mockup", "radicle")}
                </Button>
              )}
            />
          </MediaUploadCheck>
          {attributes.mediaId > 0 && (
            <Button
              variant="link"
              isDestructive
              onClick={() => setAttributes({ mediaId: 0, mediaAlt: "" })}
            >
              {__("Remove image", "radicle")}
            </Button>
          )}
        </PanelBody>
      </InspectorControls>
      <Anchor {...field("anchor")} />

      <section {...props}>
        <div className="shell flex flex-wrap items-center gap-14 pt-[clamp(32px,6vw,72px)]">
          <div className="flex min-w-0 flex-[1_1_460px] flex-col gap-[26px]">
            <Text
              plain
              tagName="span"
              className="self-start rounded-full bg-[var(--c-badge-bg,var(--color-sun))] px-4 py-2 text-sm font-bold text-[var(--c-badge-text,var(--color-ink))]"
              placeholder={__("Badge", "radicle")}
              {...field("badge")}
            />
            <Text
              tagName="h1"
              className="headline text-[clamp(56px,8vw,112px)] leading-[0.92] tracking-[-0.04em] text-[var(--c-heading,var(--color-white))]"
              placeholder={__("Headline", "radicle")}
              {...field("heading")}
            />
            <Text
              tagName="p"
              className="m-0 max-w-[520px] text-xl text-[var(--c-text,var(--color-ice))]"
              placeholder={__("Supporting text", "radicle")}
              {...field("text")}
            />
            <div className="flex flex-wrap gap-3">
              <span className="pill min-h-14 bg-[var(--c-primary-bg,var(--color-ink))] px-[30px] text-[17px] text-[var(--c-primary-text,var(--color-white))]">
                <Text
                  plain
                  tagName="span"
                  placeholder={__("Primary button", "radicle")}
                  {...field("primaryText")}
                />
                <svg
                  className="size-5"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth="2"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  aria-hidden="true"
                >
                  <path d="M5 12h14M13 6l6 6-6 6" />
                </svg>
              </span>
              <span className="pill min-h-14 bg-[var(--c-secondary-bg,var(--color-white))] px-[30px] text-[17px] text-[var(--c-secondary-text,var(--color-ink))]">
                <svg
                  className="size-[22px]"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth="1.8"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  aria-hidden="true"
                >
                  <circle cx="12" cy="12" r="10" />
                  <path d="M10 8.6v6.8a.6.6 0 0 0 .9.5l5.2-3.4a.6.6 0 0 0 0-1l-5.2-3.4a.6.6 0 0 0-.9.5z" />
                </svg>
                <Text
                  plain
                  tagName="span"
                  placeholder={__("Secondary button", "radicle")}
                  {...field("secondaryText")}
                />
              </span>
            </div>
          </div>

          <div className="relative min-w-0 flex-[1_1_520px] py-6">
            {media?.source_url ? (
              <div className={frame}>
                <img src={media.source_url} alt="" className="block h-auto w-full rounded-3xl" />
              </div>
            ) : (
              <Mockup frame={frame} />
            )}
            <Text
              plain
              tagName="span"
              className="absolute top-0 -left-3 -rotate-4 rounded-full bg-[var(--c-sticker-one-bg,var(--color-sun))] px-[18px] py-3 text-[15px] font-bold text-[var(--c-sticker-one-text,var(--color-ink))] shadow-[0_12px_24px_-12px_rgba(6,47,63,0.5)]"
              placeholder={__("Sticker", "radicle")}
              {...field("stickerOne")}
            />
            <Text
              plain
              tagName="span"
              className="absolute right-3 bottom-0 rotate-3 rounded-full bg-[var(--c-sticker-two-bg,var(--color-ink))] px-[18px] py-3 text-[15px] font-bold text-[var(--c-sticker-two-text,var(--color-white))] shadow-[0_12px_24px_-12px_rgba(6,47,63,0.5)]"
              placeholder={__("Sticker", "radicle")}
              {...field("stickerTwo")}
            />
          </div>
        </div>
      </section>
    </>
  );
}
