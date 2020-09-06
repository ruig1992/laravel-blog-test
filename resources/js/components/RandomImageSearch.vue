<template>
    <div class="random-image-search d-flex">
        <div>
            <button type="button"
                    class="btn btn-secondary d-flex align-items-center w-100"
                    @click="handleImageSearch"
            >
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                </svg>
                <span class="ml-2">Search image</span>
            </button>
            <div class="form-check mt-3 ml-1">
                <input type="checkbox"
                       class="form-check-input"
                       id="with_cache"
                       v-model="cacheEnabled"
                >
                <label class="form-check-label" for="with_cache">Enable cache</label>
            </div>
        </div>

        <div class="random-image-search__img-preview-block">
            <div v-if="image">
                <img class="random-image-search__img" :src="image.src" alt="Image">
                <p class="text-muted mt-2">Didn't find what you were looking for - <br>click "Search image" again</p>
            </div>

            <div class="pt-1 text-center" v-else-if="!searching">
                <p class="mb-2">
                    <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-card-image" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9c0 .013 0 .027.002.04V12l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094L15 9.499V3.5a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm4.502 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                    </svg>
                </p>
                <p class="text-muted">No image? First find it - click "Search image"</p>

                <p :class="{'admin-show-message': rspMessage}">
                    <span role="alert"
                          class="invalid-feedback message-feedback"
                          :class="{'text-info': !isError}"
                    >
                        <strong>{{ rspMessage }}</strong>
                    </span>
                </p>
            </div>

            <div v-else class="d-flex flex-column align-items-center justify-content-center p-2">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Searching...</span>
                </div>
                <span class="mt-2 text-muted">Searching...</span>
            </div>
        </div>

        <div>
            <button type="button"
                    class="btn btn-primary d-flex align-items-center w-100"
                    @click="handleImageInsert"
                    v-if="image"
            >
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-90deg-up" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.854 1.146a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L4 2.707V12.5A2.5 2.5 0 0 0 6.5 15h8a.5.5 0 0 0 0-1h-8A1.5 1.5 0 0 1 5 12.5V2.707l3.146 3.147a.5.5 0 1 0 .708-.708l-4-4z"/>
                </svg>
                <span class="ml-2">Insert image</span>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                image: null,
                cacheEnabled: true,
                searching: false,
                isError: false,
                rspMessage: '',
            };
        },
        methods: {
            handleImageSearch() {
                let query = document.getElementById('title').value.trim();
                if (!query) {
                    this.setResponseMessage('Enter the article title for query searching!', true);
                    return;
                }

                query = encodeURIComponent(query);
                const cache = +this.cacheEnabled;
                const url = `/admin/services/random-image/search?q=${query}&cache=${cache}`;

                this.setSearchingMode();

                window.axios.get(url)
                    .then((response) => {
                        this.setImageData(response.data.image);
                        this.setResponseMessage(response.data.msg);
                        this.searching = false;
                    })
                    .catch((error) => {
                        this.setResponseMessage(error.response.data.error || 'Error! Image not found.', true);
                        this.searching = false;
                        this.setImageData();
                    });
            },
            handleImageInsert() {
                this.$emit('insert-image', this.image.render);
            },
            setImageData(image = null) {
                this.image = image;
            },
            setResponseMessage(msg, error = false) {
                this.isError = !!error;
                this.rspMessage = msg;
            },
            setSearchingMode() {
                this.searching = true;
                this.setImageData();
                this.setResponseMessage('');
            },
        },
    }
</script>

<style scoped>
.random-image-search__img-preview-block {
    width: 370px;
    min-height: 270px;
    margin: 0 3rem;
    text-align: center;
    overflow: hidden;
}
.random-image-search__img {
    max-height: 200px;
    width: auto;
}
</style>
