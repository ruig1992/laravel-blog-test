<template>
    <form :action="action" method="POST" ref="formDelete">
        <input type="hidden" name="_token" :value="csrfToken">
        <input type="hidden" name="_method" value="DELETE">
        <button class="btn btn-sm btn-danger" type="button" @click="confirmDelete">Delete</button>
    </form>
</template>

<script>
    export default {
        props: ['action'],
        data() {
            return {
                csrfToken: document.querySelector('meta[name="csrf-token"]').content
            };
        },
        methods: {
            confirmDelete() {
                this.$swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.$refs.formDelete.submit();
                    }
                });
            }
        },
    }
</script>
