<template>
  <div>
    <Loading v-model:active="loadingStatus" loader="bars" color="rgb(2 132 199 / 0.75)"  :height="100" :width="100" background-color="rgb(203 213 225)" :opacity="0.4"/>
    <div>
        <div>
            <h4 class="text-lg sm:text-xl font-bold my-2 underline underline-offset-4">Semester {{semesterNumber}}</h4>
            <div>
                <form @submit="onSubmit">
                    <transition-group name="subject" mode="out-in" appear>
                        <!-- <div v-for="number in this.numberSubjects" :key="number">
                            <Subject :keyProp="number" @changeMonitor="updateData($event, number)" key="number" @addSubject="addSubject()"/>
                        </div>
                        <div v-if="numberSubjects < 10" id="slideButton" class="text-center sm:text-right mt-4" key="button">
                            <span @click="addSubject()" class="hover:bg-black transition duration-300 bg-sky-700 rounded-md py-1 text-white hover:cursor-pointer ">
                                <i class="bi bi-plus-lg text-xl mx-7"></i>
                            </span>
                        </div>
                        <div class="text-center mb-6 sm:mb-0 flex justify-center" key="submitter">
                            <Button text="Create Semester Entry" class="m-0 mt-6 py-3 px-6 rounded-md bg-sky-700 text-white text-xs font-normal hover:bg-black h-12 w-full sm:max-w-[300px]" @submit="onSubmit">
                                <template #extraText v-if="loadingStatus">
                                    <span class="font-bold">
                                        Processing
                                    </span>
                                </template>
                                <template #spinnerIcon v-if="loadingStatus">
                                    <span>
                                        <i class="bi bi-arrow-repeat"></i>
                                    </span>  
                                </template>
                            </Button>
                        </div> -->
                        <div v-for="number in this.numberSubjects" :key="number">
                            <Subject :keyProp="number" @changeMonitor="updateData($event, number)" key="number" @addSubject="addSubject()"/>
                        </div>
                    </transition-group>
                </form>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import Subject from '../components/Subject.vue'
import Button from '../components/Button.vue'
import { mapActions, mapGetters } from 'vuex'
import { ref } from '@vue/reactivity'

export default {
    name: 'Semester',
    components: {
        Subject,
        Button,
        Loading
    },
    props: {
        semesterNumber: [Number, String],
    },
    computed: {
        ...mapGetters(['allErrors', 'loadingStatus', 'singleAcademics']),
    },
    methods: {
        ...mapActions(['addEntryAcademics', 'getSingleEntry']),
        updateData(data, index) {
            this.subjectArray[index] = data.subject
            this.creditArray[index] = data.credit
            this.gradeArray[index] = data.grade
        },
        entrySuccess() {
            this.$emit('entrySuccess')
        },
        async onSubmit(e) {
            var i = 1;
            for(const key of Object.keys(this.subjectFormFields)) {
                this.subjectFormFields[key] = this.subjectArray[i]
                i++
            }
            i = 1;
            for(const key of Object.keys(this.creditFormFields)) {
                this.creditFormFields[key] = this.creditArray[i]
                i++
            }
            i = 1;
            for(const key of Object.keys(this.gradeFormFields)) {
                this.gradeFormFields[key] = this.gradeArray[i]
                i++
            }
            this.formFields = {...this.formFields, ...this.subjectFormFields, ...this.creditFormFields, ...this.gradeFormFields}
            this.formFields.student_id = this.$route.params.student_id
            this.formFields.semester = this.$props.semesterNumber
            e.preventDefault();
            await this.addEntryAcademics(this.formFields);
            if(Object.keys(this.allErrors).length == 0) {
                this.entrySuccess();
                this.numberSubjects = 0;
            }
        },
        addSubject() {
            if(this.numberSubjects < 10) {
                this.numberSubjects++
            }
        }
    },
    data() {
        return {
            show: ref(),
            numberSubjects: null,
            formFields: {
                student_id: null,
                semester: null,
            },
            subjectFormFields: {
                subject_1: null,
                subject_2: null,
                subject_3: null,
                subject_4: null,
                subject_5: null,
                subject_6: null,
                subject_7: null,
                subject_8: null,
                subject_9: null,
                subject_10: null,
            },
            subjectIdFromFields: {
                subject_1_id: null,
                subject_2_id: null,
                subject_3_id: null,
                subject_4_id: null,
                subject_5_id: null,
                subject_6_id: null,
                subject_7_id: null,
                subject_8_id: null,
                subject_9_id: null,
                subject_10_id: null,
            },
            creditFormFields: {
                subj_credit_1: null,
                subj_credit_2: null,
                subj_credit_3: null,
                subj_credit_4: null,
                subj_credit_5: null,
                subj_credit_6: null,
                subj_credit_7: null,
                subj_credit_8: null,
                subj_credit_9: null,
                subj_credit_10: null,
            },
            gradeFormFields: {
                subj_grade_1: null,
                subj_grade_2: null,
                subj_grade_3: null,
                subj_grade_4: null,
                subj_grade_5: null,
                subj_grade_6: null,
                subj_grade_7: null,
                subj_grade_8: null,
                subj_grade_9: null,
                subj_grade_10: null,
            },
            subjectArray: [],
            creditArray: [],
            gradeArray: [],
            semeserArray: [],
            count: 0
        }
    },
    async created() {
        await this.getSingleEntry(this.$route.params.student_id)
        console.log(this.singleAcademics)
        // console.log()
        this.semeserArray = this.singleAcademics[this.semesterNumber - 1]
        console.log(this.semeserArray)
        for(let x = 1; x <= 10; x++) {
            if(this.semeserArray[`subject_${x}`]) {
                this.count = this.count + 1
            }
        }
        console.log(this.count)
        this.show = 0;
        this.numberSubjects = this.count;
    },
}
</script>

<style>

.subject-enter-from {
    opacity: 0;
    /* transform: scale(0); */
    transform: translateY(-300px);
}
.subject-enter-to {
    opacity: 1;
    /* transform: scale(1); */
    transform: translateY(0);
}
.subject-enter-active {
    transition: all 0.5s ease;
}
.subject-move {
    transition: all 0.5s ease;
}

</style>