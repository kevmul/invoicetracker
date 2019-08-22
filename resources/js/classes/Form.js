import Errors from './Errors.js';

class Form {

    /**
     * @param  {data}
     */
    constructor(data) {
        this.originalData = data;

        for(let field in data) {
            this[field] = data[field]
        };

        this.errors = new Errors();
    }


    /**
     * @return {data object}
     */
    data() {
        let data = {};

        for (let property in this.originalData)
        {
            data[property] = this[property];
        }

        return data;
    }


    /**
     * Submit a request with Axios
     *
     * @param  {request type[post, delete, put, update]}
     * @param  {url}
     *
     * @return {Promise}
     */
    submit(requestType, url) {
        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data())
                .then(response => {
                    // console.log(response.data);
                    this.onSuccess(response.data);

                    resolve(response.data);
                })
                .catch(error => {
                    console.log(error.response.data);
                    this.onFail(error.response.data.errors);

                    reject(error.response.data);
                })
        })
    }


    /**
     * Send a post request to the server
     *
     * @param  {url}
     */
    post(url) {
        this.submit('post', url);
    }


    /**
     * returns a successful message and resets the data
     *
     * @param  {data}
     */
    onSuccess(data) {
        // flash('Success', data.message);

        this.reset();
    }


    /**
     * Records the errors if there is a failure during Submit
     *
     * @param  {errors}
     */
    onFail(errors) {
        this.errors.record(errors);
    }


    /**
     * Resets all the data
     *
     * @return {}
     */
    reset() {
        for(let field in this.data()){
            this[field] = '';
        }

        this.errors.clear();
    }
}

export default Form;
