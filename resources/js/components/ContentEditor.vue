<template>
    <div>
        <textarea class="form-control"
                  :class="{'is-invalid': isInvalid}"
                  :id="id"
                  :name="name"
                  rows="5"
                  v-model="currentValue"
        ></textarea>
        <span role="alert" class="invalid-feedback"><strong>{{ errorMsg }}</strong></span>

        <div class="mx-3 mt-4 mb-3">
            <random-image-search @insert-image="insertImage"></random-image-search>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        id: { type: String, required: true },
        name: { type: String, required: true },
        isInvalid: { type: Boolean, default: false },
        errorMsg: { type: String, default: '' },
        value: { required: false, type: String, default: '' },
    },
    data() {
        return {
            currentValue: this.getDefaultValue(),
        };
    },
    methods: {
        getDefaultValue() {
            if (this.$slots.default && this.$slots.default.length) {
                return this.$slots.default[0].text;
            }
            return this.value;
        },
        insertImage(imageUrl) {
            this.currentValue = this.renderImage(imageUrl) + this.currentValue;
        },
        renderImage(imageUrl) {
            return `<p class="blog-img-responsive"><img src="${imageUrl}" class="img-fluid" alt="Inserted random image"></p>`;
        },
    },
}
</script>
