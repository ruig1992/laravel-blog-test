<template>
    <div class="form-group" :class="{'required': required}">
        <label :for="id" class="admin-control-label">{{ label }}</label>
        <textarea class="form-control"
                  :class="{'is-invalid': isInvalid}"
                  :id="id"
                  :name="name"
                  rows="5"
                  v-model="currentValue"
        ></textarea>
        <span role="alert" class="invalid-feedback"><strong>{{ errorMsg }}</strong></span>

        <slot name="extra" :insertImage="insertImage"></slot>
    </div>
</template>

<script>
export default {
    props: {
        id: { type: String, required: true },
        name: { type: String, required: true },
        label: { type: String, required: true },
        required: { type: Boolean, default: false },
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
        insertImage(imageRender) {
            this.currentValue = imageRender + this.currentValue;
        },
    },
}
</script>
