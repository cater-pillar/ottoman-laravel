<template x-for="(value, index) in search">
    <div class="inline-block border py-1 bg-gray-100 mb-3 select-none">
        <template x-if="value.refKeys.length > 0">
            <div class="inline-block px-3 py-1">
                <span x-text="value.name + ' ' + value.logic + ' ' + value.refKeys.join(', ')"></span>
                <template x-for="refKey in value.refKeys">
                    <input type="checkbox" x-bind:name="value.name + '_' + value.logic + '_' + refKey" checked class="hidden">
                </template>
            </div>
        </template>
        <template x-if="value.refKeys.length === 0">
            <div class="inline-block px-3 py-1">
            <span  x-text="value.name + ' ' + value.logic + ' ' + value.input"></span>
            <input type="text" x-bind:name="value.name + '_' + value.logic + '_' + ++index" x-bind:value="value.input" class="hidden">
            </div>
        </template>
        <span class="select-none cursor-pointer inline-block px-3 py-1 mx-1 rounded-full hover:bg-gray-200 font-bold" 
              x-on:click="search.pop(index)">X</span>
    </div>
 </template>