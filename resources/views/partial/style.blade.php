<style>
    #pageMessages {
        position: fixed;
        bottom: 15px;
        right: 15px;
        width: 30%;
    }

    .alert {
        position: relative;
    }

    .alert .close {
        position: absolute;
        top: 5px;
        right: 5px;
        font-size: 1em;
    }

    .alert .fa {
        margin-right:.3em;
    }
    /* If the screen size is 1200px wide or more, set the font-size to 80px */
    @media (min-width: 1900px) {
        .r-font {
            font-size: 90%;
        }
        table{
            font-size: 150%
        }
        .circle{
            width: 50px;
            height: 50px;
            background: red;
            border-radius: 50%;
            margin-left: auto;
            margin-right: auto;
        }
    }
    /* If the screen size is smaller than 1200px, set the font-size to 80px */
    @media (max-width: 1899.98px) {
        .r-font {
            font-size: 90%;
        }
        table{
            font-size: 100%
        }
        .circle{
            width: 20%;
            height: 20px;
            background: red;
            border-radius: 50%;
            margin-left: auto;
            margin-right: auto;
        }
    }
</style>

