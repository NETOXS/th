document.addEventListener("DOMContentLoaded", function() {
    var shownImageIds = [];

    document.getElementById("showRandomImage").addEventListener("click", function() {
        fetch("getRandomImage.php")
            .then(response => response.json())
            .then(data => {
                var imageContainer = document.getElementById("imageContainer");
                if (data && data.id && data.image) {
                    var imageElement = document.createElement("img");
                    imageElement.src = "data:image/jpeg;base64," + data.image;
                    var containerRect = imageContainer.getBoundingClientRect();
                    var randomX = Math.floor(Math.random() * (containerRect.width - 100));
                    var randomY = Math.floor(Math.random() * (containerRect.height - 100));
                    var maxX = containerRect.width - imageElement.width;
                    var maxY = containerRect.height - imageElement.height;
                    randomX = Math.max(0, Math.min(randomX, maxX));
                    randomY = Math.max(0, Math.min(randomY, maxY));
                    imageElement.style.left = randomX + "px";
                    imageElement.style.top = randomY + "px";
                    imageContainer.appendChild(imageElement);
                    shownImageIds.push(data.id);
                }
            })
            .catch(error => {
                console.error("Erro ao obter imagem aleatória:", error);
            });
    });

    document.getElementById("resetSquare").addEventListener("click", function() {
        var imageContainer = document.getElementById("imageContainer");
        while (imageContainer.firstChild) {
            imageContainer.removeChild(imageContainer.firstChild);
        }
        shownImageIds = [];
    });
});