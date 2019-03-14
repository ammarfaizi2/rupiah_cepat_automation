 ajax(
  {
    url: "request_login_auth_code",
    data: {
      mobile: "085867152777"
    },
    success: function(ajaxData) {
      btn = 0;
      // loading.hide();
      var data = dealAjaxData(ajaxData);
      if (data.code === 400120) {
        mask.hide();
        dialog.hide();
        showTips(
          "SMS mencapai batas harian, mohon coba lagi setelah 24 jam."
        );
      } else if (data.code === 0) {
        mask.height($(document).height());

        $(".pha").hide();
        $(".time").css("display", "inline-block");
        countDown();
      } else if (data.code === 400141) {
        mask.hide();
        dialog.hide();
        showTips(
          "Anda telah mendaftar untuk Rupiah cepat,tetapi  sayangnya tidak dapat berpartisipasi dalam acara tersebut"
        );
      } else if (data.code === 402001) {
        // 一个设备IP24小时内最多可获取6次验证码
        mask.hide();
        dialog.hide();
        showTips(
          "Kode verifikasi mencapai batas harian, mohon coba lagi setelah 24 jam."
        );
      } else {
        mask.hide();
        dialog.hide();
        showTips("Tidak dapat menghubungkan ke jaringan");
      }
    },
    error: function() {
      showTips("Tidak dapat menghubungkan ke jaringan");
      btn = 0;
    }
  },
  "v2"
);