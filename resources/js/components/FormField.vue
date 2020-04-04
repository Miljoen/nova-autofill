<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <div class="dropdown-container input-append" @click="onClick">
                <v-select
                    v-model="selected"
                    :id="field.name"
                    label="label"
                    :options="this.field.options"
                    @input="onChange"
                ></v-select>
            </div>
        </template>
    </default-field>
</template>

<script>
    import { FormField, HandlesValidationErrors } from 'laravel-nova';

    export default {
        mixins: [FormField, HandlesValidationErrors],
        props: ['resourceName', 'resourceId', 'field'],
        methods: {
            /*
             * Set the initial, internal value for the field.
             */
            setInitialValue() {
                this.value = this.field.value || ''
            },
            onClick() {
                const selectedSpan = document.getElementsByClassName('vs__selected')[0];

                if(selectedSpan) {
                    selectedSpan.innerText = "";
                }
            },
            onChange(value) {
                const selectedObject = this.field.objects.find(object => object[this.field.filterKey] === value);
                const selectedSpan = document.getElementsByClassName('vs__selected')[0];

                if(selectedSpan) {
                    selectedSpan.innerText = value;
                }

                Object.keys(selectedObject).forEach((objectAttribute) => {
                    let inputField = document.getElementById(objectAttribute);
                    if(inputField) {
                        inputField.value = selectedObject[objectAttribute];
                        let event = new Event('input');
                        inputField.dispatchEvent(event);
                    }
                });
            },
            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                formData.append(this.field.attribute, this.value || '');
            },
            /**
             * Update the field's internal value.
             */
            handleChange(value) {
                this.value = value;
            },
        },
    }
</script>
