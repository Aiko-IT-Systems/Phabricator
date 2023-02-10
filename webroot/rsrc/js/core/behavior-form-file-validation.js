/**
 * @requires javelin-behavior javelin-stratcom javelin-dom
 * @provides javelin-behavior-aphront-form-file-validation
 */

JX.behavior('aphront-form-file-validation', function() {
  JX.Stratcom.listen('change', null, function(e) {
    var rawSize = e.getRawEvent().target.files[0].size;
    var mbSize = rawSize / 1024 / 1024;
    var size = bytesToSize(rawSize);
    var form = e.getNode('tag:form');
    var fileDetails = JX.$("file-size").childNodes[1];
    var csize = JX.$("csize").childNodes[1];
    var msize = JX.$("msize").childNodes[1];
    var emsize = JX.$("emsize").childNodes[1];
    fileDetails.innerText = size;
    //if (emsize.toString() == "1") {
      if (rawSize.toString() > msize.toString() || csize.innerText == "nok") {
        csize.innerText = "nok";
        JX.log("Too big file: " + size);
        form._disabled = true;
        fileDetails.innerText = "File too big, please upload via drag and drop. If you decide to upload another one, please reload the page.";
      } else {
        csize.innerText = "ok";
        JX.log("File size: " + size);
      }
    //}
  });

  function bytesToSize(bytes) {
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes === 0) return 'n/a';
    const i = Math.min(Math.floor(Math.log(bytes) / Math.log(1024)), sizes.length - 1);
    if (i === 0) return `${bytes} ${sizes[i]}`;
    return `${(bytes / (1024 ** i)).toFixed(1)} ${sizes[i]}`;
  }
});
