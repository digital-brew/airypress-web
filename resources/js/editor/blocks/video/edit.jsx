import {
  InspectorControls,
  MediaUpload,
  MediaUploadCheck,
  useBlockProps,
} from "@wordpress/block-editor";
import { Button, PanelBody, RangeControl, TextControl } from "@wordpress/components";
import { useSelect } from "@wordpress/data";
import { __ } from "@wordpress/i18n";
import { Anchor } from "../../components/Anchor";
import { ColorPanels, colorVariables } from "../../components/Colors";
import { AddItem, ItemControls, useItems } from "../../components/Items";
import { Text } from "../../components/Text";
import { UrlField } from "../../components/UrlField";
import colorGroups from "./colors";

const MediaField = ({ label, help, type, id, onSelect, onRemove }) => (
  <div className="mb-4">
    <p style={{ margin: "0 0 8px", fontWeight: 500 }}>{label}</p>
    <MediaUploadCheck>
      <MediaUpload
        allowedTypes={[type]}
        value={id}
        onSelect={onSelect}
        render={({ open }) => (
          <Button variant="secondary" onClick={open}>
            {id ? __("Replace", "radicle") : __("Upload", "radicle")}
          </Button>
        )}
      />
    </MediaUploadCheck>
    {id > 0 && (
      <Button variant="link" isDestructive onClick={onRemove}>
        {__("Remove", "radicle")}
      </Button>
    )}
    {help && <p style={{ margin: "6px 0 0", fontSize: 12, color: "#757575" }}>{help}</p>}
  </div>
);

/** A video upload stored as `<prefix>Id` + `<prefix>Url`. */
const videoField = (attributes, setAttributes, prefix, label, help) => (
  <MediaField
    label={label}
    help={help}
    type="video"
    id={attributes[`${prefix}Id`]}
    onSelect={(video) => setAttributes({ [`${prefix}Id`]: video.id, [`${prefix}Url`]: video.url })}
    onRemove={() => setAttributes({ [`${prefix}Id`]: 0, [`${prefix}Url`]: "" })}
  />
);

/* Mirrors resources/views/partials/play-button.blade.php */
const PlayButton = () => (
  <span
    className="icon-tile size-14 rounded-full bg-[var(--c-button-bg,var(--color-sun))] md:size-28 text-[var(--c-button-icon,var(--color-ink))] shadow-[0_0_3rem_rgb(255_212_92/0.35)] ring-6 ring-[var(--c-button-bg,var(--color-sun))]/25 md:ring-16 transition-transform duration-200 group-hover:scale-105 motion-reduce:transition-none"
    aria-hidden="true"
  >
    <svg className="ml-0.5 size-6 md:ml-1 md:size-11" viewBox="0 0 24 24" fill="currentColor">
      <path d="M8 5v14l11-7z" />
    </svg>
  </span>
);

export default function Edit({ attributes, setAttributes, isSelected }) {
  const props = useBlockProps({
    className: "bg-[var(--c-bg,var(--color-ink))] px-6 py-28",
    style: colorVariables(attributes.colors),
  });
  const {
    backgroundVideoUrl,
    chapters,
    embedUrl,
    overlayOpacity,
    posterId,
    posterUrl,
    video4kUrl,
    videoId,
    videoUrl,
  } = attributes;
  const actions = useItems(chapters, (chapters) => setAttributes({ chapters }));
  const field = (key) => ({
    value: attributes[key],
    onChange: (value) => setAttributes({ [key]: value }),
  });
  const length = useSelect(
    (select) => (videoId ? select("core").getMedia(videoId)?.media_details?.length_formatted : ""),
    [videoId],
  );
  const modal = videoUrl || video4kUrl;

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
        <PanelBody title={__("Background", "radicle")}>
          {videoField(
            attributes,
            setAttributes,
            "backgroundVideo",
            __("Background video", "radicle"),
            __("A short, small file (720p). Plays muted on a loop behind the overlay.", "radicle"),
          )}
          <MediaField
            label={__("Poster image", "radicle")}
            help={__(
              "Shown until the videos load, and instead of the loop for reduced motion.",
              "radicle",
            )}
            type="image"
            id={posterId}
            onSelect={(image) => setAttributes({ posterId: image.id, posterUrl: image.url })}
            onRemove={() => setAttributes({ posterId: 0, posterUrl: "" })}
          />
          <RangeControl
            label={__("Overlay opacity", "radicle")}
            value={overlayOpacity}
            onChange={(value) => setAttributes({ overlayOpacity: value ?? 45 })}
            min={0}
            max={100}
            __nextHasNoMarginBottom
          />
        </PanelBody>
        <PanelBody title={__("Video in the modal", "radicle")}>
          {videoField(
            attributes,
            setAttributes,
            "video",
            __("Video (1080p)", "radicle"),
            __(
              "Plays when the play button is clicked. Its length is shown on the button.",
              "radicle",
            ),
          )}
          {videoField(
            attributes,
            setAttributes,
            "video4k",
            __("Video (4K)", "radicle"),
            __("Optional. Adds a 1080p / 4K switch to the modal.", "radicle"),
          )}
          <UrlField
            label={__("Or embed URL (YouTube, Vimeo…)", "radicle")}
            value={embedUrl}
            onChange={(embedUrl) => setAttributes({ embedUrl })}
          />
        </PanelBody>
        <PanelBody title={__("Chapters", "radicle")}>
          {chapters.map((chapter, index) => (
            <TextControl
              key={index}
              label={`${index + 1}. ${chapter.title?.replace(/<[^>]+>/g, "") || __("Chapter", "radicle")}`}
              help={index === 0 ? __("Start time, as m:ss.", "radicle") : undefined}
              value={chapter.time ?? ""}
              onChange={(time) => actions.update(index, { time })}
              __nextHasNoMarginBottom
            />
          ))}
        </PanelBody>
      </InspectorControls>
      <Anchor {...field("anchor")} />

      <section {...props}>
        <div className="shell flex flex-col gap-14">
          <div className="flex flex-wrap items-end justify-between gap-x-10 gap-y-4">
            <div className="flex min-w-0 flex-[1_1_35rem] flex-col items-start gap-5">
              <Text
                tagName="span"
                className="rounded-full bg-[var(--c-eyebrow-bg,rgb(255_255_255/0.1))] px-4 py-2 text-[0.9375rem] font-bold text-[var(--c-eyebrow,var(--color-sun))]"
                placeholder={__("Eyebrow", "radicle")}
                {...field("eyebrow")}
              />
              <Text
                tagName="h2"
                className="headline text-[clamp(2.75rem,6vw,5rem)] leading-[0.95] tracking-[-0.04em] text-[var(--c-heading,var(--color-white))]"
                placeholder={__("Heading", "radicle")}
                {...field("heading")}
              />
            </div>
            <Text
              tagName="p"
              className="m-0 max-w-100 flex-[0_1_25rem] text-lg text-[var(--c-text,var(--color-frost))]"
              placeholder={__("Intro text", "radicle")}
              {...field("text")}
            />
          </div>

          <div className="rounded-[2.25rem] bg-[var(--c-frame,rgb(255_255_255/0.08))] p-3.5">
            <div className="relative isolate flex aspect-video items-center justify-center overflow-hidden rounded-3xl bg-[var(--c-overlay,var(--color-ink))]">
              {posterUrl && (
                <img
                  src={posterUrl}
                  alt=""
                  className="absolute inset-0 -z-10 size-full object-cover"
                />
              )}
              {backgroundVideoUrl && (
                <video
                  src={backgroundVideoUrl}
                  autoPlay
                  muted
                  loop
                  playsInline
                  aria-hidden="true"
                  className="absolute inset-0 -z-10 size-full object-cover"
                />
              )}
              <span
                className="absolute inset-0 -z-10 bg-[var(--c-overlay,var(--color-ink))]"
                style={{ opacity: overlayOpacity / 100 }}
                aria-hidden="true"
              />
              <div className="group flex flex-col items-center">
                <PlayButton />
                <span className="mt-3 md:mt-8 rounded-full bg-[var(--c-label-bg,var(--color-ink))] px-3 py-1.5 text-sm md:px-5 md:py-2.5 md:text-lg font-bold text-[var(--c-label,var(--color-white))]">
                  <Text
                    tagName="span"
                    placeholder={__("Watch the demo", "radicle")}
                    {...field("caption")}
                  />
                  {length && ` · ${length}`}
                </span>
                {!modal && (
                  <span className="mt-3 rounded-full bg-white/10 px-3 py-1 text-xs text-white">
                    {embedUrl || __("Set the videos in the block settings", "radicle")}
                  </span>
                )}
              </div>
            </div>
          </div>

          <ol className="m-0 flex list-none flex-wrap justify-center gap-3 p-0">
            {chapters.map((chapter, index) => (
              <li key={index} className="relative">
                <ItemControls
                  index={index}
                  count={chapters.length}
                  actions={actions}
                  show={isSelected}
                />
                <span className="pill min-h-10 gap-2 bg-[var(--c-chapter-bg,rgb(255_255_255/0.08))] py-1.5 pr-4 pl-2 text-base font-medium text-[var(--c-chapter,var(--color-white))] hover:shadow-none md:min-h-13 md:gap-3 md:py-2 md:pr-5 md:pl-2.5 md:text-lg">
                  <span className="icon-tile size-6 rounded-full bg-[var(--c-number-bg,var(--color-brand))] text-xs font-bold text-[var(--c-number,var(--color-white))] md:size-7 md:text-sm">
                    {index + 1}
                  </span>
                  <Text
                    tagName="span"
                    placeholder={__("Chapter", "radicle")}
                    value={chapter.title}
                    onChange={(title) => actions.update(index, { title })}
                  />
                </span>
              </li>
            ))}
            <li>
              <AddItem
                show={isSelected}
                onClick={() => actions.add({ title: "", time: "0:00" })}
                label={__("Add chapter", "radicle")}
                className="text-white"
              />
            </li>
          </ol>
        </div>
      </section>
    </>
  );
}
