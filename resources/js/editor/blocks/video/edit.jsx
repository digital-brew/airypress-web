import {
  InspectorControls,
  MediaUpload,
  MediaUploadCheck,
  useBlockProps,
} from "@wordpress/block-editor";
import { Button, PanelBody } from "@wordpress/components";
import { __ } from "@wordpress/i18n";
import { Anchor } from "../../components/Anchor";
import { ColorPanels, colorVariables } from "../../components/Colors";
import { Text } from "../../components/Text";
import { UrlField } from "../../components/UrlField";
import colorGroups from "./colors";

const MediaField = ({ label, type, id, onSelect, onRemove }) => (
  <div className="mb-4">
    <MediaUploadCheck>
      <MediaUpload
        allowedTypes={[type]}
        value={id}
        onSelect={onSelect}
        render={({ open }) => (
          <Button variant="secondary" onClick={open}>
            {label}
          </Button>
        )}
      />
    </MediaUploadCheck>
    {id > 0 && (
      <Button variant="link" isDestructive onClick={onRemove}>
        {__("Remove", "radicle")}
      </Button>
    )}
  </div>
);

export default function Edit({ attributes, setAttributes }) {
  const props = useBlockProps({ style: colorVariables(attributes.colors) });
  const { embedUrl, videoId, videoUrl, posterId, posterUrl } = attributes;

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
        <PanelBody title={__("Video", "radicle")}>
          <MediaField
            label={
              videoId ? __("Replace video file", "radicle") : __("Upload video file", "radicle")
            }
            type="video"
            id={videoId}
            onSelect={(video) => setAttributes({ videoId: video.id, videoUrl: video.url })}
            onRemove={() => setAttributes({ videoId: 0, videoUrl: "" })}
          />
          <MediaField
            label={
              posterId
                ? __("Replace poster image", "radicle")
                : __("Choose poster image", "radicle")
            }
            type="image"
            id={posterId}
            onSelect={(image) => setAttributes({ posterId: image.id, posterUrl: image.url })}
            onRemove={() => setAttributes({ posterId: 0, posterUrl: "" })}
          />
          <UrlField
            label={__("Or embed URL (YouTube, Vimeo…)", "radicle")}
            value={embedUrl}
            onChange={(embedUrl) => setAttributes({ embedUrl })}
          />
        </PanelBody>
      </InspectorControls>
      <Anchor value={attributes.anchor} onChange={(anchor) => setAttributes({ anchor })} />

      <section {...props}>
        <div
          className="flex min-h-[656px] items-center justify-center bg-[var(--c-bg,var(--color-ink))] bg-cover bg-center px-6 py-12"
          style={posterUrl ? { backgroundImage: `url(${posterUrl})` } : undefined}
        >
          <div className="flex flex-col items-center gap-4 text-center text-[var(--c-caption,var(--color-frost))]">
            <span
              className="icon-tile size-[88px] rounded-full bg-[var(--c-button-bg,var(--color-brand))] text-[var(--c-button-icon,var(--color-white))]"
              aria-hidden="true"
            >
              <svg className="size-[34px]" viewBox="0 0 24 24" fill="currentColor">
                <path d="M8 5v14l11-7z" />
              </svg>
            </span>
            <Text
              tagName="span"
              className="text-[15px]"
              placeholder={__("Caption", "radicle")}
              value={attributes.caption}
              onChange={(caption) => setAttributes({ caption })}
            />
            <span className="rounded-full bg-white/10 px-3 py-1 text-xs">
              {embedUrl || videoUrl || __("Set a video in the block settings", "radicle")}
            </span>
          </div>
        </div>
      </section>
    </>
  );
}
