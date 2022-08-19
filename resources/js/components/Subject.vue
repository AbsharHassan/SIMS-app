<template>
  <div>
    <div class=" bg-slate-100/60 rounded-md mt-6 px-3 border shadow-lg hover:shadow-2xl hover:border-blue-300 transition duration-500">
      <div class="sm:text-base font-bold mb-1 mt-4">Subject {{this.key}}</div>
      <hr class="w-[30%] text-black">
      <div class="mt-4 md:flex">
        <div class="basis-[40%] md:pr-3 mb-6">
            <label class="inline-block text-md mb-2 font-medium">Title</label>
            <input type="text" class="bg-slate-200 border border-slate-400 rounded p-2 w-full focus:outline-none focus:border-2 focus:border-cyan-700 transition duration-1000 h-[40px]" v-model="this.formFields.subject" @input="changeMonitor()"/>
        </div>
        <div class="basis-[20%] md:pr-3 mb-6">
            <label class="inline-block text-md mb-2 font-medium">Subject ID</label>
            <input type="text" class="bg-slate-200 border border-slate-400 rounded p-2 w-full focus:outline-none focus:border-2 focus:border-cyan-700 transition duration-1000 h-[40px]" v-model="this.formFields.id" @input="changeMonitor()"/>
        </div>
        <div class="basis-[20%] md:pr-3 mb-6">
            <label class="inline-block text-md mb-2 font-medium">Credit Hours</label>
            <input type="number" min="1" max="8" step="1" class="bg-slate-200 border border-slate-400 rounded p-2 w-full focus:outline-none focus:border-2 focus:border-cyan-700 transition duration-1000 h-[40px]" v-model="this.formFields.credit" @input="changeMonitor()"/>
        </div>
        <div class="basis-[20%] mb-6">
            <label class="inline-block text-md mb-2 font-medium">Grade Obtained</label>
            <select v-model="formFields.grade" id="grade" class="bg-slate-200 border border-slate-400 rounded p-2 w-full focus:outline-none focus:border-2 focus:border-cyan-700 transition duration-1000 h-[40px]" @change="changeMonitor()">
              <option value="A">A</option>
              <option value="B+">B+</option>
              <option value="B">B</option>
              <option value="C+">C+</option>
              <option value="C">C</option>
              <option value="D+">D+</option>
              <option value="D">D</option>
              <option value="F">F</option>
            </select>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
    name: 'Subject',
    props: {
        keyProp: Number,
        semesterNumber: Number,
        studentID: String,
    },
    methods: {
        changeMonitor() {
          this.$emit('changeMonitor', this.formFields)
        },
        addSubject() {
          this.$emit('addSubject')
        }
    },
    data() {
      return {
        key: null,
        formFields: {
          subject: null,
          id: null,
          credit: null,
          grade: null,
        }
      }
    },
    created() {
      this.key = this.$props.keyProp;
    },
}
</script>

<style>

</style>