/**
 * @requires javelin-behavior javelin-stratcom javelin-dom
 * @provides javelin-behavior-aphront-form-file-validation
 */

JX.behavior('aphront-form-file-validation', function() {
  JX.Stratcom.listen('change', null, function(e) {
    var mbSize = e.getRawEvent().target.files[0].size / 1024 / 1024;
    var size = bytesToSize(e.getRawEvent().target.files[0].size);
    JX.log("Trying to get detail field");
    var fileDetails = JX.$N('div', {className: 'aphront-form-control-static file-size'});
    console.log(fileDetails);
    if (mbSize > 100) {
      JX.DOM.setContent(fileDetails, size);
      //JX.DOM.show(JX.$('file'));
      //JX.DOM.hide(JX.$('file-size-error'));
      JX.log("Too big file: " + size);
    } else {
      JX.log("File size: " + size);
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
