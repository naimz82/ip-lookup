$("#frmHomeIpLook").on("submit", function(e){
    e.preventDefault();
    let iplookaddr = $("#iplookaddr").val();
    $.ajax({
        url: "iplookup.php",
        method: "POST",
        data: { iplookaddr: iplookaddr },
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                $("#IpInfo").html(response.msg);
            } else {
                $("#IpInfo").html("<em>No information found.</em>");
            }
        },
        error: function () {
            $("#IpInfo").html("<em>Error occurred while fetching data.</em>");
        },
        beforeSend: function() {
            $("#IpInfo").html("Loading...");
        }
    });
});