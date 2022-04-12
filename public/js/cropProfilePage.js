$("#profile-image-input").on("change", function () {
    $(".left-side").css("margin-top", "50px");
    $(".profile-image").remove();
    $(".profile-image-label").remove();

    $uploadCrop = $("#upload-input").croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200,
            type: "circle",
        },
        boundary: {
            width: 300,
            height: 300,
        },
    });
    var reader = new FileReader();
    reader.onload = function (e) {
        $uploadCrop
            .croppie("bind", {
                url: e.target.result,
            })
            .then(function () {
                console.log("jQuery bind complete");
            });
    };
    reader.readAsDataURL(this.files[0]);
});

$(".update-profile-button").on("click", function (event) {
    // console.log($(".profile-image-input").get(0));
    if ($("#profile-image-input").val() !== "") {
        event.preventDefault();
        $("#upload-input")
            .croppie("result", {
                type: "canvas",
                size: "viewport",
            })
            .then(function (response) {
                axios
                    .put("/update-profile-image", {
                        croppedImage: response,
                    })
                    .then((response) => {
                        $(".profile-form").submit();
                    });
            });
    }
});
