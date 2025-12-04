async function loadComponent(id, file) {
    const resp = await fetch(file);
    const html = await resp.text();
    document.getElementById(id).innerHTML = html;
}

loadComponent("header", "components/header.html");
loadComponent("footer", "components/footer.html");
