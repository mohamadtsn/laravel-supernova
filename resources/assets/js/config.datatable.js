(()=>{var n;(()=>{if(KTUtil.isRTL()){$.extend(!0,$.fn.dataTable.defaults,{aLengthMenu:[[10,25,50,-1],[10,25,50,"همه"]],oLanguage:{oAria:{sortAscending:": مرتب سازی صعودی",sortDescending:": مرتب کردن نزولی"},oPaginate:{sFirst:"صفحه اول",sLast:"صفحه آخر",sNext:"صفحه بعد",sPrevious:"صفحه قبل"},sEmptyTable:"اطلاعاتی برای نمایش وجود ندارد!",sInfo:"نمایش _START_ تا _END_ از _TOTAL_ رکورد",sInfoEmpty:"هیچ رکوردی برای نمایش وجود ندارد!",sInfoFiltered:"(فیلتر شده از _MAX_ رکورد)",sLengthMenu:"نمایش _MENU_ تایی",sLoadingRecords:"در حال بارگذاری...",sProcessing:"در حال پردازش...",sSearch:"جستجو: ",sSearchPlaceholder:"جستجو کنید...",sZeroRecords:"هیچ مورد مطابقی یافت نشد"}})}})(),n={init:function(){this.AdminList.init(),this.Roles.init()},Default:{init:function(){this.index()},index:function(){$("#".concat("default_datatable")).DataTable({responsive:!0})}},AdminList:{init:function(){this.index()},index:function(){$("#".concat("datatable_admin_list")).DataTable({responsive:!0})}},Roles:{init:function(){this.index()},index:function(){$("#".concat("datatable_roles")).DataTable({responsive:!0})}}},$((function(){n.init()}))})();