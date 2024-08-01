# Documentação da API

## **1. Artistas**

### **1.1 Criar Novo Artista**

- **Endpoint:** `POST /artists`
- **Descrição:** Adiciona um novo artista.
- **Parâmetros:**
  - **Body** (JSON):
    - `name` (string, obrigatório): Nome do artista.

- **Resposta:**
  - **Código 201 Created**
  - **Exemplo de resposta:**
    ```json
    {
      "id": 1,
      "name": "Nome do Artista"
    }
    ```

### **1.2 Listar Artista com Álbuns e Faixas**

- **Endpoint:** `GET /artists/{id}`
- **Descrição:** Recupera um artista específico, incluindo seus álbuns e faixas.
- **Parâmetros:**
  - **Path**:
    - `id` (integer, obrigatório): ID do artista.

- **Resposta:**
  - **Código 200 OK**
  - **Exemplo de resposta:**
    ```json
    {
      "id": 1,
      "name": "Nome do Artista",
      "albums": [
        {
          "id": 1,
          "name": "Nome do Álbum",
          "tracks": [
            {
              "id": 1,
              "name": "Nome da Faixa",
              "duration": "3:20"
            }
          ]
        }
      ]
    }
    ```

## **2. Álbuns**

### **2.1 Criar Novo Álbum**

- **Endpoint:** `POST /albums`
- **Descrição:** Adiciona um novo álbum.
- **Parâmetros:**
  - **Body** (JSON):
    - `name` (string, obrigatório): Nome do álbum.
    - `artist_id` (integer, obrigatório): ID do artista.
    - `release_year` (string, opcional): Ano de lançamento do álbum.
    - `image_url` (string, opcional): URL da imagem do álbum.

- **Resposta:**
  - **Código 201 Created**
  - **Exemplo de resposta:**
    ```json
    {
      "id": 1,
      "name": "Nome do Álbum",
      "artist_id": 1,
      "artist_name": "Nome do Artista",
      "release_year": "2023",
      "image_url": "http://example.com/image.jpg"
    }
    ```

### **2.2 Listar Álbum por Nome**

- **Endpoint:** `GET /albums/{name}`
- **Descrição:** Recupera álbuns com base no nome.
- **Parâmetros:**
  - **Path**:
    - `name` (string, obrigatório): Nome do álbum.

- **Resposta:**
  - **Código 200 OK**
  - **Exemplo de resposta:**
    ```json
    [
      {
        "id": 1,
        "name": "Nome do Álbum",
        "artist_id": 1,
        "artist_name": "Nome do Artista",
        "release_year": "2023",
        "image_url": "http://example.com/image.jpg"
      }
    ]
    ```

### **2.3 Deletar Álbum**

- **Endpoint:** `DELETE /albums/{id}`
- **Descrição:** Remove um álbum existente.
- **Parâmetros:**
  - **Path**:
    - `id` (integer, obrigatório): ID do álbum.

- **Resposta:**
  - **Código 204 No Content**

## **3. Faixas**

### **3.1 Criar Nova Faixa**

- **Endpoint:** `POST /tracks`
- **Descrição:** Adiciona uma nova faixa.
- **Parâmetros:**
  - **Body** (JSON):
    - `name` (string, obrigatório): Nome da faixa.
    - `album_id` (integer, obrigatório): ID do álbum.
    - `music_url` (string, opcional): URL da música.
    - `duration` (string, opcional): Duração da faixa.

- **Resposta:**
  - **Código 201 Created**
  - **Exemplo de resposta:**
    ```json
    {
      "id": 1,
      "name": "Nome da Faixa",
      "album_id": 1,
      "album_name": "Nome do Álbum",
      "music_url": "http://example.com/music.mp3",
      "duration": "3:20"
    }
    ```

### **3.2 Deletar Faixa**

- **Endpoint:** `DELETE /tracks/{id}`
- **Descrição:** Remove uma faixa existente.
- **Parâmetros:**
  - **Path**:
    - `id` (integer, obrigatório): ID da faixa.

- **Resposta:**
  - **Código 204 No Content**

### **3.3 Listar Faixas por ID do Álbum**

- **Endpoint:** `GET /tracks/album/{albumId}`
- **Descrição:** Recupera todas as faixas de um álbum específico.
- **Parâmetros:**
  - **Path**:
    - `albumId` (integer, obrigatório): ID do álbum.

- **Resposta:**
  - **Código 200 OK**
  - **Exemplo de resposta:**
    ```json
    [
      {
        "id": 1,
        "name": "Nome da Faixa",
        "album_id": 1,
        "album_name": "Nome do Álbum",
        "music_url": "http://example.com/music.mp3",
        "duration": "3:20"
      }
    ]
    ```

### **3.4 Listar Faixas por Nome**

- **Endpoint:** `GET /tracks/name/{name}`
- **Descrição:** Recupera faixas com base no nome da faixa.
- **Parâmetros:**
  - **Path**:
    - `name` (string, obrigatório): Nome da faixa.

- **Resposta:**
  - **Código 200 OK**
  - **Exemplo de resposta:**
    ```json
    [
      {
        "id": 1,
        "name": "Nome da Faixa",
        "album_id": 1,
        "album_name": "Nome do Álbum",
        "music_url": "http://example.com/music.mp3",
        "duration": "3:20"
      }
    ]
    ```

---

Esse `README.md` pode ser utilizado para documentar sua API e fornecer aos desenvolvedores informações necessárias para utilizar os endpoints disponíveis. Se precisar de mais alguma coisa, é só avisar!
