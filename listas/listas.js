console.log("Ola")

async function try_add_list(id_book) {
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