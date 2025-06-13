(function () {
  const e = document.createElement("link").relList;
  if (e && e.supports && e.supports("modulepreload")) return;
  for (const i of document.querySelectorAll('link[rel="modulepreload"]')) s(i);
  new MutationObserver((i) => {
    for (const r of i)
      if (r.type === "childList")
        for (const a of r.addedNodes)
          a.tagName === "LINK" && a.rel === "modulepreload" && s(a);
  }).observe(document, { childList: !0, subtree: !0 });
  function t(i) {
    const r = {};
    return (
      i.integrity && (r.integrity = i.integrity),
      i.referrerPolicy && (r.referrerPolicy = i.referrerPolicy),
      i.crossOrigin === "use-credentials"
        ? (r.credentials = "include")
        : i.crossOrigin === "anonymous"
        ? (r.credentials = "omit")
        : (r.credentials = "same-origin"),
      r
    );
  }
  function s(i) {
    if (i.ep) return;
    i.ep = !0;
    const r = t(i);
    fetch(i.href, r);
  }
})();
const f = 3e3,
  u = 100,
  m = 6e5;
class c {
  constructor() {
    (this._alertBox = document.getElementById("custom-alert-box")),
      (this._alertOverlay = document.getElementById("custom-alert-overlay"));
  }
  addElementsToBody(...e) {
    e.forEach((t) => document.body.insertAdjacentElement("beforeend", t));
  }
  getElementIfExists(e) {
    return document.querySelector(e) || !1;
  }
  addClasses(e, ...t) {
    e &&
      e.classList &&
      e.classList.add(...t.filter((s) => typeof s == "string"));
  }
  removeClasses(e, ...t) {
    e &&
      e.classList &&
      e.classList.remove(...t.filter((s) => typeof s == "string"));
  }
  addAttributes(e, ...t) {
    if (!e || t.length === 0) return console.error("Parameters are incorrect");
    t.forEach((s) => e.setAttribute(s, ""));
  }
  changeAttributes(e, [...t], [...s]) {
    if (!(e || t.length === 0 || s.length === 0) || t.length !== s.length)
      return console.error("Parameters are incorrect");
    t.forEach((i, r) => e.setAttribute(i, s[r]));
  }
  removeAttributes(e, ...t) {
    if (!e || t.length === 0) return console.warn("Parameters are incorrect");
    t.forEach((s) => e.removeAttribute(s));
  }
  toggleElementVisibility(e, t) {
    e.hasAttribute("checked") &&
      document.getElementById(t).classList.remove("hidden");
  }
  updateElementValue(e, t) {
    if (!e) return this.showAlert("Element could not found", "error");
    e.value = t;
  }
  clearFieldViaBtn(e) {
    e.parentElement.querySelector("input").value = "";
  }
  resetCheckBoxesViaTrigger(e) {
    const t = e.dataset.itemscontainer;
    document
      .getElementById(t)
      .querySelectorAll("input[type='checkbox']")
      .forEach((r) => {
        r.hasAttribute("checked") && r.click();
      });
  }
  _hideAlert() {
    this._alertBox.classList.add("hidden"),
      this._alertOverlay.classList.add("hidden");
  }
  showAlert(e, t = "success", s = f, i = null) {
    this.alertTimeout && clearTimeout(this.alertTimeout),
      this._hideAlert(),
      (this._alertBox.innerHTML = ""),
      (this._alertBox.style.cssText = ""),
      this.removeClasses(
        this._alertBox,
        "success",
        "error",
        "modal-active",
        "inline-alert",
        "fixed-alert",
        "mt-3"
      );
    const r = document.createTextNode(e);
    this._alertBox.appendChild(r), this.addClasses(this._alertBox, t);
    let a = !1;
    const o = i ? i.closest("div") : null;
    if (o) {
      const n = getComputedStyle(o),
        l = o.parentElement,
        h = l ? getComputedStyle(l) : null;
      (["flex", "grid"].includes(n.display) ||
        (h && ["flex", "grid"].includes(h.display))) &&
        (a = !0);
    }
    if ((this.removeClasses(this._alertBox, "hidden"), a)) {
      this.addClasses(this._alertBox, "modal-active"),
        this.removeClasses(overlay, "hidden");
      const n = document.createElement("button");
      (n.innerHTML = "&times;"),
        (n.className = "alert-close-button"),
        this._alertBox.appendChild(n),
        (this.closeButtonClickListener = () => this._hideAlert()),
        n.addEventListener("click", this.closeButtonClickListener),
        (this.overlayClickListener = (l) => {
          l.target === overlay && this._hideAlert();
        }),
        overlay.addEventListener("click", this.overlayClickListener);
    } else {
      if (o) {
        this.addClasses(this._alertBox, "inline-alert");
        const n = o.getBoundingClientRect();
        getComputedStyle(this._alertBox),
          (this._alertBox.style.top = `${n.bottom + window.scrollY}px`),
          (this._alertBox.style.left = `${n.left + window.scrollX}px`),
          (this._alertBox.style.width = `${n.width}px`);
        const l = parseFloat(getComputedStyle(o).marginBottom);
        (isNaN(l) || l < 10) && this.addClasses(this._alertBox, "mt-3"),
          this._alertBox.classList.contains("mt-3") &&
            parseFloat(getComputedStyle(this._alertBox).marginTop);
      } else this.addClasses(this._alertBox, "fixed-alert");
      this.alertTimeout = setTimeout(this._hideAlert.bind(this), s);
    }
  }
}
class g extends c {
  _isEmptyInput(e) {
    return !e.value;
  }
  removeBorderColor(e) {
    e.classList.forEach((t) => {
      t.startsWith("border-") && e.classList.remove(t);
    }),
      (e.style.borderColor = "");
  }
  addBorderColor(e, t) {
    if (!(e || t))
      return this.showAlert("Element or Classname is not provided", "error");
    this.removeBorderColor(e), e.classList.add(t);
  }
  clearField(e) {
    const t = document.getElementById(e);
    if (this._isEmptyInput(t))
      return super.showAlert("Field is already empty.");
    t.value = "";
  }
  _createItemEl(e) {
    const t = document.createElement("span");
    return (
      (t.textContent = e),
      t.classList.add("p-0.5", "bg-green-400", "text-gray-700", "rounded-sm"),
      t
    );
  }
  showMultipleItems(e, t) {
    const s = document.getElementById(t);
    if (!s)
      return this.showAlert("Input container could not be found", "error");
    (s.innerHTML = ""),
      !(e.length < 1) &&
        e.forEach((i) => {
          if (i) {
            const r = this._createItemEl(i);
            s.insertAdjacentElement("beforeend", r);
          }
        });
  }
}
class p extends c {
  constructor(e, t) {
    super(), (this._formId = e), (this._submitterId = t), this._init();
  }
  _init() {
    if (
      ((this.form = document.getElementById(this._formId) || void 0),
      (this.formSubmitter =
        document.getElementById(this._submitterId) || void 0),
      !this.form || !this.formSubmitter)
    )
      return super.showAlert(
        "Could not find the given form or submitter",
        "error"
      );
  }
  addChangeHandler(e) {
    this.form.addEventListener("change", e);
  }
  addClickHandler(e) {
    this.form.addEventListener("click", e);
  }
  addInputHandler(e) {
    this.form.addEventListener("input", e);
  }
  addPasteHandler(e) {
    this.form.addEventListener("paste", e);
  }
  addFocusOutHandler(e) {
    this.form.addEventListener("focusout", e);
  }
  addSubmitHandler(e) {
    this.form.addEventListener("submit", e);
  }
  addFormDataHandler(e) {
    this.form.addEventListener("formdata", e);
  }
}
class b extends c {
  constructor(e, t) {
    super(),
      (this.tabsContainerID = e),
      (this.tabsContentContainerId = t),
      this._checkTabsExist();
  }
  _checkTabsExist() {
    if (
      ((this.tabsContainer = this.getElementIfExists(
        `#${this.tabsContainerID}`
      )),
      (this.tabsContentContainer = this.getElementIfExists(
        `#${this.tabsContentContainerId}`
      )),
      !this.tabsContainer || !this.tabsContentContainer)
    )
      return this.showAlert(
        `Tabs container (ID: ${this.tabsContainerID}) or Content container (ID: ${this.tabsContentContainerId}) does not exist.`,
        "error"
      );
  }
  _hideAllTabs() {
    Array.from(this.tabsContainer.querySelectorAll("button")).forEach((t) => {
      t.classList.contains("tab-active") && t.classList.add("tab-inactive");
    });
  }
  _hideAllTabsContents() {
    Array.from(
      this.tabsContentContainer.querySelectorAll(".tab-content")
    ).forEach((t) => {
      t.classList.contains("hidden") || t.classList.add("hidden");
    });
  }
  showTab(e) {
    if (!e) return this.showAlert("Provided tab does not exist", "error");
    this._hideAllTabs(),
      e.classList.remove("tab-inactive"),
      e.classList.add("tab-active"),
      this._showTabContent(e.dataset.relation);
  }
  _showTabContent(e) {
    const t = this.getElementIfExists(`#${e}`);
    if (!t)
      return this.showAlert(`Provided tab (ID: ${e}) does not exist`, "error");
    this._hideAllTabsContents(), t.classList.remove("hidden");
  }
}
class w extends c {
  constructor() {
    super();
  }
  toggleChecked(e) {
    e.hasAttribute("checked")
      ? e.removeAttribute("checked")
      : e.setAttribute("checked", "");
  }
  revealElement(e) {
    const t = document.getElementById(e.dataset.elementid);
    e.hasAttribute("checked")
      ? t.classList.remove("hidden")
      : t.classList.add("hidden");
  }
  resetToggle(e) {
    e.click();
  }
  resetToggles(e) {
    const t = document.getElementById(e);
    if (!t) return this.showAlert("Toggle container is not found", "error");
    t.querySelectorAll("input[type='checkbox']").forEach((i) => {
      i.hasAttribute("checked") && i.click();
    });
  }
}
class y {
  constructor() {
    (this.formView = new p("wpti-admin-form", "form-submit-btn")),
      (this.tabsView = new b("tabs-button-wrapper", "tabs-content-wrapper")),
      (this.toggleView = new w()),
      (this.fieldView = new g()),
      this._addControllers();
  }
  _addControllers() {
    this.formView.addClickHandler(this._controlClicks.bind(this)),
      this.formView.addChangeHandler(this._controlChange.bind(this)),
      this.formView.addInputHandler(this._controlInput.bind(this)),
      this.formView.addPasteHandler(this._controlPaste.bind(this)),
      this.formView.addFocusOutHandler(this._controlFocusOut.bind(this));

    // removed for post submission
    // this.formView.addSubmitHandler(this._controlSubmit.bind(this)),
    // this.formView.addFormDataHandler(this._controlFormData.bind(this));
  }
  _delayWidget(e) {
    const t = e.value;
    if (t < u)
      return this.fieldView.showAlert(
        `Minimum delay limit is ${u}ms!`,
        "error"
      );
    if (t > m)
      return this.fieldView.showAlert(
        `Maximum delay limit is ${m}ms!`,
        "error"
      );
  }
  _removeLastCharacter(e) {
    return e.slice(0, e.length - 1);
  }
  _createMultiplePageIdItems(e) {
    return e.includes(",")
      ? e
          .split(",")
          .map((t) => t.trim())
          .filter((t) => t)
      : [e];
  }
  _showMultiplePageIds(e) {
    const t = e.value;
    if (this._hasMultiplePageIdsError(t)) {
      this.fieldView.showAlert(
        "Must be a comma-separated list of page IDs (e.g., 1,23,456).",
        "error"
      ),
        this.fieldView.updateElementValue(e, this._removeLastCharacter(t));
      return;
    }
    const s = this._createMultiplePageIdItems(e.value);
    this.fieldView.showMultipleItems(s, e.dataset.displayid);
  }
  _hasMultiplePageIdsError(e) {
    const t = e.trim();
    return !!(t && !/^[0-9]+(,[0-9]+)*,?$/.test(t.replace(/\s/g, "")));
  }
  _sanitizeCSSSelectorInput(e) {
    let t = e.value;
    const s = e.selectionStart;
    if (t) {
      if ((t.length > 0 && !/^[#.]/.test(t) && (t = ""), t.length > 1)) {
        const i = t[0],
          a = t.substring(1).replace(/[^a-zA-Z0-9\-_]/g, "");
        t = i + a;
      }
      this.fieldView.updateElementValue(e, t), e.setSelectionRange(s, s);
    }
  }
  _validateCSSSelector(e) {
    const t = e.value.trim();
    if (!t) return;
    /^[#\.][a-zA-Z0-9\-_]+$/.test(t) ||
      this.fieldView.showAlert(
        "Selector must start with # or . and have a valid name (e.g., #my-id or .my-class)",
        "error"
      );
  }
  _sanitizeKeyValueInput(e, t) {
    let s;
    t ? (s = t.clipboardData.getData("text")) : (s = e.value);
    let i = e.selectionStart,
      r = s.replace(/[^a-zA-Z0-9\-_:, ]/g, "");
    if (/^\s*,/.test(r)) {
      const o = r.length;
      (r = r.replace(/^\s*,/, "")), (i -= o - r.length);
    }
    const a = /([^,:\s])\s+([^,:\s])/g;
    if ((a.test(r) && ((r = r.replace(a, "$1, $2")), i++), r.endsWith(","))) {
      const o = r.slice(0, -1),
        n = o.lastIndexOf(",");
      o.substring(n + 1).includes(":") || (r = r.slice(0, -1));
    }
    (r = r.replace(/,{2,}/g, ",").replace(/:{2,}/g, ":")),
      this.fieldView.updateElementValue(e, r),
      e.setSelectionRange(Math.max(0, i), Math.max(0, i));
  }
  _validateKeyValueOnBlur(e) {
    const t = e.value.trim();
    if (!t) return;
    const s = t.split(",");
    let i = !1;
    for (const r of s) {
      const a = r.trim();
      if (a === "") {
        i = !0;
        break;
      }
      const o = a.split(":");
      if (o.length !== 2 || !o[0].trim() || !o[1].trim()) {
        i = !0;
        break;
      }
    }
    i
      ? (this.fieldView.showAlert(
          'Invalid format. Use "key:value" pairs, separated by commas (e.g., name:John, plan:pro).',
          "error"
        ),
        e.classList.add("border-red-500"),
        setTimeout(() => {
          this.fieldView.removeBorderColor(e);
        }, 2e3),
        (e.value = ""))
      : ((e.style.borderColor = ""), e.classList.add("border-green-500"));
  }
  _controlClicks(e) {
    const t = e.target.closest("button");
    t &&
      (t.classList.contains("tab-btn") && this.tabsView.showTab(t),
      t.dataset.role === "reset" &&
        this.toggleView.resetToggles(t.dataset.itemscontainer),
      t.dataset.role === "clear" &&
        this.fieldView.clearField(t.dataset.elementid));
  }
  _controlChange(e) {
    const t = e.target,
      s = t.closest("input[role='switch']");
    t.closest("input[type='text']"),
      s &&
        (this.toggleView.toggleChecked(s),
        s.dataset.role === "reveal" && this.toggleView.revealElement(s));
  }
  _controlInput(e) {
    const t = e.target;
    t.dataset.role === "hide-on-pages-input" && this._showMultiplePageIds(t),
      t.id === "input-selector" && this._sanitizeCSSSelectorInput(t),
      t.id === "custom-attributes-input" && this._sanitizeKeyValueInput(t),
      t.id === "pages-to-ignore-tagging-input" && this._showMultiplePageIds(t),
      t.id === "delay-widget-display" && this._delayWidget(t);
  }
  async _controlFocusOut(e) {
    const t = e.target;
    if (!t.getAttribute("type") !== "text") {
      if (t.dataset.role === "tawk-api-key-input")
        if (t.value) await this._validateTawkAPIKey(t.value);
        else {
          const s = document.getElementById(t.dataset.toggleid);
          return this.toggleView.resetToggle(s);
        }
      t.dataset.role === "input-selector" && this._validateCSSSelector(t),
        t.id === "custom-attributes-input" && this._validateKeyValueOnBlur(t);
    }
  }
  _controlPaste(e) {
    const t = e.target,
      s = e.clipboardData.getData("text");
    if (t.id === "hide-on-pages-input")
      if (this._hasMultiplePageIdsError(s)) {
        this.fieldView.showAlert(
          "Pasted text contain invalid characters",
          "error"
        ),
          e.preventDefault();
        return;
      } else this.fieldView.showAlert("Text pasted successfully");
    t.id === "custom-attributes-input" &&
      (this._sanitizeKeyValueInput(t, e), e.preventDefault());
  }
  _controlSubmit(e) {
    if ((e.preventDefault(), e.submitter !== this.formView.formSubmitter))
      return (
        console.log(e.submitter),
        console.log(this.formView.formSubmitter),
        this.formView.showAlert(
          "Event submitter is not same as submit button",
          "error"
        )
      );
    new FormData(this.formView.form, this.formView.formSubmitter),
      this.formView.showAlert("Form submitted. Have a nice day!", "success");
  }
  _controlFormData(e) {
    const t = e.formData;
    for (const [s, i] of t.entries())
      i && console.log(`Key: ${s}, Value: ${i}`);
  }
}
window.addEventListener("load", function () {
  new y();
});
