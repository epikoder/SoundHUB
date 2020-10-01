var Toast = function () {
    this.text;
    this.closeType;
};
Toast.prototype = {
    /**
     * Show text
     * @param {string} _text
     * @param {boolean|Number} _close
     */
    show: (_text, _close) => {
        this.text = _text;
        if (typeof _close === 'boolean') {
            self.closeType = _close;
        } else {
            self.duration = _close;
        }
    },

    /**
     * Make the view
     */
    make: () => {
        if (this.closeType) {
            var closeToast = document.createElement("div");
            let span = document.createElement("span");
            span.className = "pl-4 pr-2 text-sm closeToast";
            span.innerHTML = "x";
            closeToast.appendChild(span);
        } else {
            var bar = document.createElement("div");
            bar.className = "toastBar h-1 bg-blue-500";
        }
        let toast = document.createElement('div');
        let toastInner = document.createElement('div');
        toast.className = 'toast';
        toastInner.className = 'p-2 flex justify-between';
        toastInner.innerHTML = l;
    },
    setText: () => {
        let text = document.createElement('div');
        return text.appendChild(this.text)
    }
}


let toast =
    `<div class="toast">
            <div class="p-2 flex justify-between">
                <div class"px-2">
                ` +
    text +
    `
                </div>
                ` +
    closeToast +
    `
            </div>
            ` +
    bar +
    `
        </div>`;

body.innerHTML += toast;
if ($(".toast").get([0]) && $(".toastClose").get([0])) {
    $(".closeToast").on("click", function() {
        $(".toast").remove();
    });
} else if (duration) {
    durationHandler(duration);
} else {
    $(document).on("click", function() {
        $(".toast").remove();
    });
}

async function durationHandler(duration) {
    let bar = $(".toastBar");
    let barPercent = 100;
    let durationLeft;
    let x = 1;
    let timeout = 50;
    bar.width(barPercent + "%");
    const interval = setInterval(() => {
        durationLeft = duration - timeout * x++;
        barPercent = (durationLeft / duration) * 100;
        if (durationLeft <= 0) {
            $(".toast").remove();
            clearInterval(interval);
        }
        bar.width(barPercent + "%");
    }, timeout);
}
