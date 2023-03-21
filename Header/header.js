class Header {
    static clickBtnPhone(element) {
        const iconPhoneContent = element.parentNode.querySelector("button.phone-Btn").querySelector("i.material-icons");
        const ul = element.parentNode.querySelector("ul");
        ul.style.flexDirection = "column";
        if (iconPhoneContent.innerHTML == "dehaze") {
            iconPhoneContent.innerHTML = "close";
            ul.style.display = "flex";
            if (document.body.width > 700) {
                ul.style.animation = "iPadShowContent";
                ul.style.animationDuration = "0.8s";
            }
            else {
                ul.style.animation = "phoneShowContent";
                ul.style.animationDuration = "0.8s";
            }
        }
        else {
            iconPhoneContent.innerHTML = "dehaze";
            if (document.body.width > 700) {
                ul.style.animation = "iPadCloseContent";
                ul.style.animationDuration = "0.8s";
            }
            else {
                ul.style.animation = "phoneCloseContent";
                ul.style.animationDuration = "0.8s";
            }
            setTimeout(() => { ul.style.display = "none"; }, 500);
        }
    }
}