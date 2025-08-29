function copyReq(id) {
    let reqId = id;
    bId = "#" + id;
    let reqValue = $(bId).closest(".line").find(".value").html();
    //alert(reqValue);
    BX.clipboard.bindCopyClick(
        BX(reqId),
        {
            text: reqValue
        }
    );
}