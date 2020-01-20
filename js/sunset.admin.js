jQuery(document).ready($ => {
  var mediaUploader;

  $("#upload-button").on("click", e => {
    e.preventDefault();
    if (mediaUploader) {
      mediaUploader.open();
      return;
    }
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: "Choose a Profile Picture",
      button: {
        text: "Choose Picture"
      },
      multiple: false
    });
    mediaUploader.on("select", () => {
      attachment = mediaUploader
        .state()
        .get("selection")
        .first()
        .toJSON();
      $("#profile-picture").val(attachment.url);
      $("#profile-picture-preview").css(
        "background-image",
        "url(" + attachment.url + ")"
      );
    });
    mediaUploader.open();
  });
});
