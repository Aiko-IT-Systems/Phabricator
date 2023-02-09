/**
 * @requires javelin-behavior javelin-stratcom javelin-dom
 * @provides javelin-behavior-aphront-form-file-validation
 */

JX.behavior('aphront-form-file-validation', function() {
  JX.Stratcom.listen('change', null, function(e) {
    var size = bytesToSize(e.getRawEvent().target.files[0].size);
    if (size.contains("MB") || size.contains("GB") || size.contains("TB")) {
      JX.DOM.setContent(JX.$('file-size'), size);
      JX.DOM.show(JX.$('file-size'));
      JX.DOM.hide(JX.$('file-size-error'));
      JX.log("Too big file: " + size);
    }
  });

  function bytesToSize(bytes) {
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes === 0) return 'n/a';
    const i = Math.min(Math.floor(Math.log(bytes) / Math.log(1024)), sizes.length - 1);
    if (i === 0) return `${bytes} ${sizes[i]}`;
    return `${(bytes / (1024 ** i)).toFixed(1)} ${sizes[i]}`;
  }
});
