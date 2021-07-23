import {get} from "lodash";

export default {
    data() {
        return {
            errors: {},
        }
    },
    methods: {
        /**
         * Returns errors by its key. Vuetify also supports string as error,
         * @param fieldName
         * @return {Array<String>|String}
         */
        getErrors(fieldName) {
            return get(this.errors, fieldName);
        },
        /**
         * Resets certain error by its key
         * @param fieldName
         */
        resetError(fieldName) {
            delete this.errors[fieldName];
        },
        /**
         * Resets all errors in current component
         */
        resetAllErrors() {
            this.errors = {};
        }
    }
}
