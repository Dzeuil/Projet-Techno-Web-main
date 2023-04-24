window.onload = () => {
    var codeZone = document.getElementById("codeZone");
    codeZone.addEventListener("change", updateFile);
};

function updateFile() {
    const urlParams = new URLSearchParams(window.location.search);
    var data = {
        filename: urlParams.get("file"),
        newcontent: codeZone.value
    };
    //console.log(JSON.stringify(data));
    fetch("http://localhost/api/filesep.php", { method: "POST", headers: {"Content-Type": "application/json"}, body: JSON.stringify(data)}).then((response) => console.log(response.text()));
}