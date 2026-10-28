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

export default function Edit({ attributes, setAttributes }) {
  const props = useBlockProps({
    className: "gutter relative isolate overflow-x-clip pb-[clamp(24px,3vw,40px)] text-white",
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
        <span
          className="absolute inset-x-0 top-0 bottom-[clamp(140px,24vw,340px)] -z-10 bg-[var(--c-bg,var(--color-brand))]"
          aria-hidden="true"
        />

        <div className="shell flex flex-col items-center gap-7 pt-[clamp(48px,7vw,100px)] text-center">
          <Text
            plain
            tagName="span"
            className="rounded-full bg-[var(--c-badge-bg,var(--color-sun))] px-4 py-2 text-sm font-bold text-[var(--c-badge-text,var(--color-ink))]"
            placeholder={__("Badge", "radicle")}
            {...field("badge")}
          />
          <Text
            tagName="h1"
            className="headline max-w-[1000px] text-[clamp(60px,11vw,150px)] leading-[0.88] tracking-[-0.05em] text-[var(--c-heading,var(--color-white))]"
            placeholder={__("Headline", "radicle")}
            {...field("heading")}
          />
          <Text
            tagName="p"
            className="m-0 max-w-[640px] text-[clamp(18px,1.6vw,21px)] text-[var(--c-text,var(--color-ice))]"
            placeholder={__("Supporting text", "radicle")}
            {...field("text")}
          />
          <div className="flex flex-wrap justify-center gap-3">
            <span className="pill min-h-14 bg-[var(--c-primary-bg,var(--color-ink))] px-[30px] text-[17px] text-[var(--c-primary-text,var(--color-white))]">
              <Text
                plain
                tagName="span"
                placeholder={__("Primary button", "radicle")}
                {...field("primaryText")}
              />
            </span>
            <span className="pill min-h-14 bg-[var(--c-secondary-bg,var(--color-white))] px-[30px] text-[17px] text-[var(--c-secondary-text,var(--color-ink))]">
              <svg className="size-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M7 4.8v14.4a1 1 0 0 0 1.5.86l11.7-7.2a1 1 0 0 0 0-1.72L8.5 3.94A1 1 0 0 0 7 4.8z" />
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

        <div className="relative mx-auto mt-[clamp(48px,6vw,80px)] max-w-[1200px]">
          <div className="rounded-[1.25rem] bg-white p-[clamp(8px,1.1vw,16px)] pt-0 shadow-[0_40px_80px_-30px_rgba(6,47,63,0.45)]">
            <div
              className="relative flex min-h-[clamp(44px,4.5vw,64px)] items-center justify-center"
              aria-hidden="true"
            >
              <span className="absolute left-[clamp(8px,1.5vw,20px)] flex gap-2">
                <span className="size-3 rounded-full bg-line" />
                <span className="size-3 rounded-full bg-line" />
                <span className="size-3 rounded-full bg-line" />
              </span>
              <span className="rounded-full bg-mist px-4 py-1.5 text-sm text-ink-soft max-sm:hidden">
                clientco.com/wp-admin
              </span>
            </div>
            {media?.source_url ? (
              <img
                src={media.source_url}
                alt=""
                className="block h-auto w-full rounded-[1.25rem]"
              />
            ) : (
              <Mockup />
            )}
          </div>
          <Text
            plain
            tagName="span"
            className="absolute -top-7 -left-2 -rotate-4 rounded-full bg-[var(--c-sticker-one-bg,var(--color-sun))] px-5 py-3.5 font-display text-[clamp(15px,1.4vw,19px)] font-bold text-[var(--c-sticker-one-text,var(--color-ink))] shadow-[0_12px_24px_-12px_rgba(6,47,63,0.5)]"
            placeholder={__("Sticker", "radicle")}
            {...field("stickerOne")}
          />
          <Text
            plain
            tagName="span"
            className="absolute top-[28%] -right-2 rotate-3 rounded-full bg-[var(--c-sticker-two-bg,var(--color-ink))] px-5 py-3.5 font-display text-[clamp(15px,1.4vw,19px)] font-bold text-[var(--c-sticker-two-text,var(--color-white))] shadow-[0_12px_24px_-12px_rgba(6,47,63,0.5)]"
            placeholder={__("Sticker", "radicle")}
            {...field("stickerTwo")}
          />
          <span className="absolute -bottom-6 left-[12%] flex -rotate-2 items-center gap-3 rounded-full bg-[var(--c-sticker-three-bg,var(--color-white))] px-5 py-3.5 font-display text-[clamp(15px,1.4vw,19px)] font-bold text-[var(--c-sticker-three-text,var(--color-ink))] shadow-[0_12px_24px_-12px_rgba(6,47,63,0.5)]">
            <span className="size-4 flex-none rounded-full bg-[var(--c-sticker-three-dot,var(--color-brand))]" />
            <Text
              plain
              tagName="span"
              placeholder={__("Sticker", "radicle")}
              {...field("stickerThree")}
            />
          </span>
        </div>
      </section>
    </>
  );
}
