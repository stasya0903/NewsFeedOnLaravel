<template>
    <form v-on:submit.prevent="onSubmit">

        <label for="email">Email</label>
        <input id='email' type="email" v-model="email">
        <input type="submit">


    </form>
</template>

<script>
    export default {
        data() {
            return {
                email: ' ',
                errors: ' '

            }
        },
        methods: {
            async onSubmit() {
                if (this.validEmail(this.email)) {
                    const result = await fetch(`api/sendForm`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({email: this.email})
                    });
                    const data = await result;
                    console.log(data);


                }

            },
            validEmail(email) {
                var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            }
        }

    }
</script>

<style scoped>

</style>
