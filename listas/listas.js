console.log("Ola")

async function try_add_to_favorites(id_book) {
    try {
        const formData = new FormData();
        formData.append("id_book", id_book);

        const response = await fetch("add_to_favorites.php", {
            method: "POST",
            body: formData
        });

        const result = await response.json();

        if (!response.ok) {
            throw new Error(result.message);
        }

        alert(result.message);

    } catch (error) {
        console.error("Erro ao adicionar favorito:", error);
        alert(error.message || "Não foi possível adicionar o livro.");
    }
}

async function change_list(id_book, list) {
    try {
        const formData = new FormData();
        formData.append("id_book", id_book);
        formData.append("id_lista", list);

        const response = await fetch("change_list.php", {
            method: "POST",
            body: formData
        });

        const text = await response.text();

        const result = JSON.parse(text);

        if (!response.ok) {
            throw new Error(result.message);
        }

        alert(result.message);

    } catch (error) {
        console.error("Erro ao mudar lista:", error);
        alert(error.message || "Não foi possível mudar a lista.");
    }
}