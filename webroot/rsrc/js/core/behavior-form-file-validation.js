/**
 * @requires javelin-behavior javelin-stratcom javelin-dom
 * @provides javelin-behavior-aphront-form-file-validation
 */

JX.behavior('aphront-form-file-validation', function() {
  JX.Stratcom.listen('change', null, function(e) {
    var mbSize = e.getRawEvent().target.files[0].size / 1024 / 1024;
    var size = bytesToSize(e.getRawEvent().target.files[0].size);
    var fileDetails = JX.$("file-size").childNodes[1];
    var csize = JX.$("csize").childNodes[1];
    fileDetails.innerText = size;
    if (mbSize > 100) {
      csize.innerText = "nok";
      JX.log("Too big file: " + size);
    } else {
      csize.innerText = "ok";
      JX.log("File size: " + size);
    }
  });

  JX.Stratcom.listen('keydown', ['tag:form', 'tag:textarea'], function(e) {
    var raw = e.getRawEvent();
    if (!(e.getSpecialKey() === 'return' && (raw.ctrlKey || raw.metaKey))) {
      return;
    }
    try {
      var csize = JX.$("csize").childNodes[1];
      if (csize.innerText === "nok") {
        e.preventDefault();
        JX.log("Too big file");
      } else {
        JX.log("File size ok");
        form = e.getNode('tag:form');
        form.submit();
      }
    } catch (e) {
      e.kill();
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
