import { MediaUpload, MediaUploadCheck } from "@wordpress/block-editor";
import { Button } from "@wordpress/components";
import { store as coreStore } from "@wordpress/core-data";
import { useSelect } from "@wordpress/data";
import { __ } from "@wordpress/i18n";

/**
 * URL of a media library item, for previewing an image attribute in the editor.
 */
export const useMediaUrl = (id) =>
  useSelect((select) => (id ? select(coreStore).getMedia(id)?.source_url : undefined), [id]);

/**
 * Inspector control to pick, replace or remove an image stored as an attachment ID.
 */
export const MediaField = ({ label, value, onChange }) => (
  <div style={{ marginBottom: 16 }}>
    <p style={{ margin: "0 0 8px", fontWeight: 500 }}>{label}</p>
    <MediaUploadCheck>
      <MediaUpload
        allowedTypes={["image"]}
        value={value}
        onSelect={(image) => onChange(image.id)}
        render={({ open }) => (
          <Button variant="secondary" onClick={open}>
            {value ? __("Replace image", "radicle") : __("Upload image", "radicle")}
          </Button>
        )}
      />
    </MediaUploadCheck>
    {value > 0 && (
      <Button variant="link" isDestructive onClick={() => onChange(0)}>
        {__("Remove", "radicle")}
      </Button>
    )}
  </div>
);
