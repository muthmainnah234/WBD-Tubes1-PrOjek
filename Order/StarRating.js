class StarRating extends HTMLElement {
    get value () {
        return this.getAttribute('value') || 0;
    }

    set value (val) {
        this.setAttribute('value', val);
        this.highlight(this.value);
    }

    get number () {
        return this.getAttribute('number') || 5;
    }

    set number (val) {
        this.setAttribute('number', val);

        for (let i = 0; i < this.number; i++) {
            document.getElementById("star_"+i).src = "StarEmpty.png"
        }

        this.value = this.value;
    }

    highlight (index) {
        for (let i = 0; i < index; i++) {
            document.getElementById("star_"+i).src = "Star.png"
        }
        for (let i = index; i < this.number; i++) {
            document.getElementById("star_"+i).src = "StarEmpty.png"
        }
    }

    constructor () {
        super();

        this.number = this.number;

        this.addEventListener('mousemove', e => {
            let box = this.getBoundingClientRect(),
            starIndex = Math.floor((e.pageX - box.left) / 200 * this.number);
            this.highlight(starIndex + 1);

        });

        this.addEventListener('mouseout', () => {
            this.value = this.value;
        });

        this.addEventListener('click', e => {
            let box = this.getBoundingClientRect(),
            starIndex = Math.floor((e.pageX - box.left) / 200 * this.number);

            this.value = starIndex + 1;
            let rateEvent = new Event('rate');
            this.dispatchEvent(rateEvent);
        });
    }
}

customElements.define('star-rating', StarRating);