document.addEventListener("DOMContentLoaded", function () {
    var generatePdfButtons = document.querySelectorAll('.generatePdfButton');

    generatePdfButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            console.log('Button clicked');
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "{{ route('generate.pdf') }}");
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.responseType = "blob"; // Treat response as binary data

            xhr.onload = function () {
                if (xhr.status === 200) {
                    var blob = new Blob([xhr.response], { type: 'application/pdf' });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = 'generated_pdf.pdf';
                    link.click();
                }
            };

            xhr.send(JSON.stringify({}));
        });
    });
});