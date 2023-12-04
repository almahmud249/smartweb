import {ref} from "vue";

export default function globalValue() {


    function collapsMenu() {
        const sidebar = document.getElementById("sidebar");
        const collaps = document.getElementById("collaps");
        const expand = document.getElementById("expand");
        const aside_link_wraper = document.getElementById("aside_link_wraper");
        const logo_img = document.getElementById("logo_img");
        const links = document.getElementsByClassName("menu_link");
        const aside_link = document.getElementsByClassName("aside_link");
        const link_group_title = document.getElementsByClassName("link_group_title");
        const hoverable_links = document.getElementsByClassName("hoverable_link");
        sidebar.style.width = "fit-content";
        aside_link_wraper.style.overflowY = "initial";
        aside_link_wraper.style.padding = 0;
        collaps.style.display = "none";
        expand.style.display = "block";
        for (let i = 0; i < links.length; i++) {
            const link = links[i];
            link.style.justifyContent = "center";
            const down_arrow = document.querySelector(".rt_icon");
            for (let i = 0; i < down_arrow.length; i++) {
                const element = array[i];
                element.style.display = "none";
            }
            if (link.nextElementSibling && link?.nextElementSibling?.tagName === "UL") {
                link.nextElementSibling.style.display = "none";
                link.nextElementSibling.classList.remove("show");
                if (!link.nextElementSibling.classList.contains("hover_sub_menu")) {
                    console.log(link, "link");
                    link.style.display = "none";
                }
                // console.log(link.classList.remove("menu_link"),"link");
            }
        }
        for (let i = 0; i < aside_link.length; i++) {
            const element = aside_link[i];
            element.style.width = 0;
            element.style.overflow = "hidden";
            element.style.display = "inline-block";
        }
        for (let i = 0; i < link_group_title.length; i++) {
            const element = link_group_title[i];
            element.style.display = "none";
        }
        for (let i = 0; i < hoverable_links.length; i++) {
            console.log((hoverable_links[i].style.display = "block"));
        }
        logo_img.style.display = "none";
    }
    const openSidebar = document.getElementById("openSidebar");
    const collaps = document.getElementById("collaps");
    const sidebar = document.getElementById("sidebar");

    const closeMenu = () => {
        collaps.style.display = "none";
        sidebar.style.display = "none";
        sidebar.style.zIndex = "5";
    };
    function expandMenu() {
        const sidebar = document.getElementById("sidebar");
        const collaps = document.getElementById("collaps");
        const expand = document.getElementById("expand");
        const aside_link_wraper = document.getElementById("aside_link_wraper");
        const logo_img = document.getElementById("logo_img");
        const links = document.getElementsByClassName("menu_link");
        const aside_link = document.getElementsByClassName("aside_link");
        const link_group_title = document.getElementsByClassName("link_group_title");
        const hoverable_links = document.getElementsByClassName("hoverable_link");
        sidebar.style.width = "auto";
        aside_link_wraper.style.overflowY = "scroll";
        collaps.style.display = "block";
        expand.style.display = "none";
        aside_link_wraper.style.padding = "20PX";
        for (let i = 0; i < links.length; i++) {
            const link = links[i];
            link.style.justifyContent = "center";
            const down_arrow = document.querySelector(".rt_icon");
            for (let i = 0; i < down_arrow.length; i++) {
                const element = array[i];
                element.style.display = "block";
            }
            if (link.nextElementSibling && link?.nextElementSibling?.tagName === "UL") {
                link.nextElementSibling.style.display = "block";
                link.nextElementSibling.classList.remove("show");
                if (!link.nextElementSibling.classList.contains("hover_sub_menu")) {
                    link.style.display = "flex";
                }
            }
        }
        for (let i = 0; i < aside_link.length; i++) {
            const element = aside_link[i];
            element.style.width = "100%";
            element.style.overflow = "initial";
            element.style.display = "block";
        }
        for (let i = 0; i < link_group_title.length; i++) {
            const element = link_group_title[i];
            element.style.display = "block";
        }
        for (let i = 0; i < hoverable_links.length; i++) {
            console.log((hoverable_links[i].style.display = "none"));
        }
        logo_img.style.display = "block";
    }



    return {expandMenu,collapsMenu,}
}
