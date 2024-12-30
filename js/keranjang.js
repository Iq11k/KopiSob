function numberFormat(element) {
    element.value = element.value
        .replace(/[^0-9.]/g, "")
        .replace(/(\..*)\./g, "$1");
}

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".increment").forEach((button) => {
        button.addEventListener("click", function () {
            var id = this.getAttribute("data-id");
            var input = this.previousElementSibling;
            var currentValue = parseInt(input.value);
            var newValue = currentValue + 1;

            if (newValue >= 0) {
                input.value = newValue;

                fetch("update-jumlah.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `id=${id}&jumlah=${newValue}`,
                })
                    .then((response) => response.text())
                    .then((data) => {
                        console.log("Jumlah berhasil diupdate");
                        location.reload();
                    })
                    .catch((error) => {
                        console.error(
                            "Terjadi kesalahan saat mengupdate jumlah",
                            error
                        );
                    });
            }
        });
    });

    document.querySelectorAll(".decrement").forEach((button) => {
        button.addEventListener("click", function () {
            var id = this.getAttribute("data-id");
            var input = this.nextElementSibling;
            var currentValue = parseInt(input.value);
            var newValue = currentValue - 1;

            if (newValue >= 0) {
                input.value = newValue;

                fetch("update-jumlah.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `id=${id}&jumlah=${newValue}`,
                })
                    .then((response) => response.text())
                    .then((data) => {
                        console.log("Jumlah berhasil diupdate");
                        location.reload();
                    })
                    .catch((error) => {
                        console.error(
                            "Terjadi kesalahan saat mengupdate jumlah",
                            error
                        );
                    });
            }
        });
    });

    document.querySelectorAll(".value").forEach((input) => {
        input.addEventListener("keyup", function () {
            var id = this.getAttribute("data-id");
            var newValue = parseInt(this.value);

            if (newValue >= 0) {
                fetch("update-jumlah.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `id=${id}&jumlah=${newValue}`,
                })
                    .then((response) => response.text())
                    .then((data) => {
                        console.log("Jumlah berhasil diupdate");
                        location.reload();
                    })
                    .catch((error) => {
                        console.error(
                            "Terjadi kesalahan saat mengupdate jumlah",
                            error
                        );
                    });
            } else {
                this.value = 0;
            }
        });
    });
    document.querySelectorAll("#hapus").forEach((input) => {
        input.addEventListener("click", function () {
            var id = this.getAttribute("data-id");

            fetch("hapus-pesanan.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `id=${id}`,
            })
                .then((response) => response.text())
                .then((data) => {
                    console.log("item berhasil dihapus");
                    location.reload();
                })
                .catch((error) => {
                    console.error("Terjadi kesalahan saat hapus item", error);
                });
        });
    });
    document.querySelectorAll("#cetak_pdf").forEach((input) => {
        input.addEventListener("click", function () {
            location.href = "keranjang.php?status=success";
            console.log("cetak");
        });
    });
});
setTimeout(() => {
    const alert = document.getElementById("alert-message");
    if (alert) {
        alert.style.opacity = "0";
        setTimeout(() => alert.remove(), 300);
    }
}, 2000);