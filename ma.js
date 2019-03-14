// ç½‘é¡µæ‰“ç‚¹
// å°è£…æ‰“ç‚¹äº‹ä»¶
// verä¸ºç‰ˆæœ¬å·
/**
 * åŸºäºŽ
 *  <!-- æ‰“ç‚¹ -->
    <script src="../activePublic/common.js"></script>
    <script src="../activePublic/crypt-js.js"></script>
    <script src="../activePublic/secret.js"></script>
    <script src="../js/dot.js"></script>
 *
 * å‚æ•°:
    a: String, é¡µé¢ç¼–ç ;
    b: String, æ‰“ç‚¹ç¼–ç ;
 *
 */
function dotEvent(a, b) {
  var baseHost = '';
  if (window.location.host === 'h5.rupiahcepatweb.com') {
    baseHost = 'https://api.rupiahcepatweb.com/';
  } else {
    baseHost = 'http://microl-api-test.toolkits.mobi/';
  }
  var content = {};
  var pkg = 'com.loan.cash.credit.easy.kilat.cepat.pinjam.uang.dana.rupiah';
  var uiver = '10048';
  var ver = '4.0.6.6011';
  content.dev = {
    'time': formatDateTime(),
    'imei_hash': returnImeiHash(),
    'android_id': '',
    'dist': 'BR',
    'lang': '',
    'model': '',
    'manu': '',
    'sdk': '',
    'op': '',
    'mcc': '',
    'reso': '',
    'mem': '',
    'cpu_num': '',
    'disk_use': '',
    'cpu_type': ''
  };
  content.app = {
    'pkg': 'com.loan.cash.credit.easy.kilat.cepat.pinjam.uang.dana.rupiah',
    'ver': ver,
    'top_chl': '',
    'sub_chl': ''
  };
  content.action = {
    'a': a,
    'v': b,
    't': formatDateTime()
  };
  content = JSON.stringify(content);
  var sendUrl = baseHost + 'api/v2/dot/dot2?data=';
  var sendData = { 'pkg': pkg, 'ver': ver, 'uiver': uiver, 'content': content };
  // åŠ å¯†post Data
  sendData = getAES(JSON.stringify(sendData));
  $.ajax({
    url: sendUrl + sendData,
    type: 'GET',
    dataType: 'jsonp',
    success: function(data) {
      console.log(data);
    },
    error: function(error) {
      console.log(error);
    }
  });
}

// è®¾ç½®iMeiHashï¼ˆæ—¶é—´æˆ³+éšæœº6ä½å­—ç¬¦ä¸²ï¼‰
function returnImeiHash() {
  var iMeihash = getCookie('iMeihash');
  if (!iMeihash) {
    setCookie('iMeihash', formatDateTime() + randomString(6));
    iMeihash = getCookie('iMeihash');
  }
  return iMeihash;
}

// èŽ·å–ä»»æ„ä½å­—ç¬¦ä¸²
function randomString(len) {
  len = len || 32;
  var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678'; /** **é»˜è®¤åŽ»æŽ‰äº†å®¹æ˜“æ··æ·†çš„å­—ç¬¦oOLl,9gq,Vv,Uu,I1****/
  var maxPos = $chars.length;
  var pwd = '';
  for (i = 0; i < len; i++) {
    pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
  }
  return pwd;
}

// æ—¶é—´æˆ³è½¬æ¢æ—¥æœŸ (yyyy-MM-dd HH:mm:ss)
function formatDateTime() {
  var timeValue = new Date().getTime();
  var date = new Date(timeValue);
  var y = date.getFullYear();
  var m = date.getMonth() + 1;
  m = m < 10 ? ('0' + m) : m;
  var d = date.getDate();
  d = d < 10 ? ('0' + d) : d;
  var h = date.getHours();
  h = h < 10 ? ('0' + h) : h;
  var minute = date.getMinutes();
  var second = date.getSeconds();
  minute = minute < 10 ? ('0' + minute) : minute;
  second = second < 10 ? ('0' + second) : second;
  return y + '-' + m + '-' + d + ' ' + h + ':' + minute + ':' + second;
}


