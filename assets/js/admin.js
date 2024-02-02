jQuery(document).ready(function ($) {
  const prefix = "_FNPC_settings_";
  if (FNPC && FNPC?.fnpc_category_1 !== undefined) {
    console.log("service is", FNPC?.fnps_category_1);
    $(".fnpc_category_1_select").val(FNPC?.fnpc_category_1);
    $(".fnpc_category_2_select").val(FNPC?.fnpc_category_2);
    $(".fnpc_category_3_select").val(FNPC?.fnpc_category_3);
    $(".fnpc_category_4_select").val(FNPC?.fnpc_category_4);
    $(".fnpc_category_5_select").val(FNPC?.fnpc_category_5);
    $(".fnpc_category_6_select").val(FNPC?.fnpc_category_6);
  }
});
