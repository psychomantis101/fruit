import './bootstrap';

import { createApp } from 'vue'

import Fruit from './components/fruit'

const app = createApp({})

app.component('fruit', Fruit)

app.mount('#app')
