<template>
    <div
        style="overflow-x: hidden"
        class="bulk_import body_wraper p-md-5 p-3"
    >
        <div class="mb-4">
            <!-- page title start -->
            <div>
                <h1 class="page-header-title">
                    <img src="" alt/>
                    Bulk Import
                </h1>
            </div>
            <!-- page title end -->
        </div>

        <div class="cm_box mb-5 p-0">
            <div class="p-5">
                <h1 class="instruction_heading">Instructions :</h1>
                <ul class="instruction_list">
                    <li>
                        1. Download the format file and fill it with proper data.
                    </li>
                    <li>
                        2. You can download the example file to understand how the
                        data must be filled.
                    </li>
                    <li>
                        3. Once you have downloaded and filled the format file upload
                        it in the form below and submit.
                    </li>
                    <li>
                        4. After uploading products you need to edit them and set
                        products images and choices.
                    </li>
                    <li>
                        5. You can get brand and category id from their list please
                        input the right ids.
                    </li>
                    <li>
                        6. You can upload your product images in product folder from
                        gallery and copy image`s path.
                    </li>
                </ul>
            </div>
        </div>

        <div class="file_upload cm_box mb-5 p-0">
            <div class="p-5">
                <h4>
                    Import Products File
                    <a
                        href=""
                        class="btn-link text-capitalize fz-16 font-weight-medium"
                        style="color: #24bac3; text-decoration: none"
                    >Download Format</a
                    >
                </h4>
                <div>
                    <form @submit.prevent=submit>
                        <div class="file_upload_input">
                            <input
                                type="file"
                                @input="pickFile($event.target.files[0])"
                                id="upload_input_file"
                                style="display: none"
                            />
                            <label for="upload_input_file" class="d-flex justify-center">
                                <img
                                    src="https://backend.bppshop.com.bd/assets/back-end/img/drag-upload-file.png"
                                    alt=""
                                    style="cursor: pointer; width:100%"
                                    width="100%"
                                    class="cursor-pointer"
                                    id="not_file"

                                />
                                <img
                                    src=""
                                    alt=""
                                    style="
                        cursor: pointer;
                        display: none;
                        padding: 20px 30px;
                        margin: auto;
                        max-width: 200px;
                        width:100%;
                      "
                                    class=""
                                    id="has_file"
                                />
                            </label>
                        </div>
                        <div
                            class="d-flex flex-wrap gap-10 align-items-center justify-content-end"
                        >
                            <button
                                type="reset"
                                id="reset"
                                class="btn_reset btn btn-secondary px-4"
                            >
                                Reset
                            </button>
                            <button
                                type="submit" :disabled="form.processing"
                                class="btn_submit btn btn--primary px-4 ms-2"
                            >
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import webpageLayout from "../Layouts/WebpageLayout.vue";
import {useForm} from "@inertiajs/vue3";

export default {
    name: "BulkImport",
    layout: webpageLayout,
    data() {
        return {
            form: useForm({
                file: ''
            })
        }
    },
    methods: {
        submit() {
            this.form.post(route('city.bulk.import', this.form))
        },
        pickFile(files) {
            this.form.file = files
            this.filePreview()
        },
        filePreview() {
            const upload_input_file = document.getElementById("upload_input_file");
            const not_file = document.getElementById("not_file");
            const has_file = document.getElementById("has_file");
            const file = upload_input_file.files[0];
            if (file?.name) {
                not_file.style.display = "none";
                has_file.style.display = "block";
            } else {
                not_file.style.display = "block";
                has_file.style.display = "none";
            }
        }
    },
}
</script>
<style scoped>
.bulk_import .instruction_heading {
  font-size: 2rem;
  font-weight: 600;
  line-height: 1.4;
}
.bulk_import .instruction_list {
  list-style: none;
  padding-left: 0;
  display: grid;
  grid-gap: 16px;
  margin-top: 10px;
}
.bulk_import .btn_reset {
  background-color: #f4f5f7;
  border-color: #f4f5f7;
  color: #334257;
  font-size: 14px;
  padding: 8px 24px;
}
.bulk_import .btn_reset:hover {
  background-color: #ededed;
  border-color: #ededed;
}
.bulk_import .btn_submit {
  background-color: #0177cd;
  color: white;
  font-size: 14px;
  padding: 8px 24px;
}
.bulk_import .btn_submit:hover {
  background-color: #0177cd;
  border-color: #0177cd;
  color: white;
}
.bulk_import .file_upload h4 {
  font-size: 1.6rem;
  font-weight: 600;
  line-height: 1.4;
  text-align: center;
}
.bulk_import .file_upload_input {
  max-width: 682px;
  margin: auto;
  margin-top: 50px;
  margin-bottom: 10px;
}
.bulk_import .file_upload_input label {
  height: 150px;
  width: 100%;
}

@media screen and (max-width: 800px) {
  .bulk_import .file_upload_input label {
    width: 100%;
    height: 100px;
  }
}/*# sourceMappingURL=bulkimport.css.map */
</style>
