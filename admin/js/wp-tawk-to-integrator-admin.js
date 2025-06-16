(function () {
  const t = document.createElement("link").relList;
  if (t && t.supports && t.supports("modulepreload")) return;
  for (const i of document.querySelectorAll('link[rel="modulepreload"]')) s(i);
  new MutationObserver((i) => {
    for (const r of i)
      if (r.type === "childList")
        for (const o of r.addedNodes)
          o.tagName === "LINK" && o.rel === "modulepreload" && s(o);
  }).observe(document, { childList: !0, subtree: !0 });
  function e(i) {
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
    const r = e(i);
    fetch(i.href, r);
  }
})();
const h = 2e3,
  u = 100,
  m = 6e5;
class f {
  constructor() {
    (this._alertBox = document.getElementById("custom-alert-box")),
      (this._alertOverlay = document.getElementById("custom-alert-overlay"));
  }
  showAlert(t, e = "success", s = h, i = null) {
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
    const r = document.createTextNode(t);
    this._alertBox.appendChild(r), this.addClasses(this._alertBox, e);
    let o = !1;
    const a = i ? i.closest("div") : null;
    if (a) {
      const n = getComputedStyle(a),
        l = a.parentElement,
        c = l ? getComputedStyle(l) : null;
      (["flex", "grid"].includes(n.display) ||
        (c && ["flex", "grid"].includes(c.display))) &&
        (o = !0);
    }
    if ((this.removeClasses(this._alertBox, "hidden"), o)) {
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
      if (a) {
        this.addClasses(this._alertBox, "inline-alert");
        const n = a.getBoundingClientRect();
        getComputedStyle(this._alertBox),
          (this._alertBox.style.top = `${n.bottom + window.scrollY}px`),
          (this._alertBox.style.left = `${n.left + window.scrollX}px`),
          (this._alertBox.style.width = `${n.width}px`);
        const l = parseFloat(getComputedStyle(a).marginBottom);
        (isNaN(l) || l < 10) && this.addClasses(this._alertBox, "mt-3"),
          this._alertBox.classList.contains("mt-3") &&
            parseFloat(getComputedStyle(this._alertBox).marginTop);
      } else this.addClasses(this._alertBox, "fixed-alert");
      this.alertTimeout = setTimeout(this._hideAlert.bind(this), s);
    }
  }
  _hideAlert() {
    this._alertBox.classList.add("hidden"),
      this._alertOverlay.classList.add("hidden");
  }
  addClasses(t, ...e) {
    t &&
      t.classList &&
      t.classList.add(...e.filter((s) => typeof s == "string"));
  }
  removeClasses(t, ...e) {
    t &&
      t.classList &&
      t.classList.remove(...e.filter((s) => typeof s == "string"));
  }
}
class g {
  _isEmptyInput(t) {
    return !t.value;
  }
  removeBorderColor(t) {
    t.classList.forEach((e) => {
      e.startsWith("border-") && t.classList.remove(e);
    }),
      (t.style.borderColor = "");
  }
  addBorderColor(t, e) {
    if (!(t || e)) return console.error("Element or Classname is not provided");
    this.removeBorderColor(t), t.classList.add(e);
  }
  clearField(t) {
    const e = document.getElementById(t);
    if (this._isEmptyInput(e)) return console.error("Field is already empty.");
    e.value = "";
  }
  _createItemEl(t) {
    const e = document.createElement("span");
    return (
      (e.textContent = t),
      e.classList.add("p-0.5", "bg-green-400", "text-gray-700", "rounded-sm"),
      e
    );
  }
  showMultipleItems(t, e) {
    const s = document.getElementById(e);
    if (!s) return console.error("Input container could not be found");
    (s.innerHTML = ""),
      !(t.length < 1) &&
        t.forEach((i) => {
          if (i) {
            const r = this._createItemEl(i);
            s.insertAdjacentElement("beforeend", r);
          }
        });
  }
}
class p {
  constructor(t, e) {
    (this._formId = t), (this._submitterId = e), this._init();
  }
  _init() {
    if (
      ((this.form = document.getElementById(this._formId) || void 0),
      (this.formSubmitter =
        document.getElementById(this._submitterId) || void 0),
      !this.form || !this.formSubmitter)
    )
      return console.error("Could not find the given form or submitter");
  }
  addChangeHandler(t) {
    this.form.addEventListener("change", t);
  }
  addClickHandler(t) {
    this.form.addEventListener("click", t);
  }
  addInputHandler(t) {
    this.form.addEventListener("input", t);
  }
  addPasteHandler(t) {
    this.form.addEventListener("paste", t);
  }
  addFocusOutHandler(t) {
    this.form.addEventListener("focusout", t);
  }
  addSubmitHandler(t) {
    this.form.addEventListener("submit", t);
  }
  addFormDataHandler(t) {
    this.form.addEventListener("formdata", t);
  }
}
class b {
  constructor(t, e) {
    (this.tabsContainerID = t),
      (this.tabsContentContainerId = e),
      (this.activeTab = document.getElementById("tab-active")),
      this._checkTabsExist();
  }
  _checkTabsExist() {
    if (
      ((this.tabsContainer = document.getElementById(this.tabsContainerID)),
      (this.tabsContentContainer = document.getElementById(
        this.tabsContentContainerId
      )),
      !this.tabsContainer || !this.tabsContentContainer)
    )
      return console.error(
        `Tabs container (ID: ${this.tabsContainerID}) or Content container (ID: ${this.tabsContentContainerId}) does not exist.`
      );
  }
  _hideAllTabs() {
    Array.from(this.tabsContainer.querySelectorAll(".tab-btn")).forEach((e) => {
      e.classList.remove("tab-active");
    });
  }
  _hideAllTabsContents() {
    Array.from(
      this.tabsContentContainer.querySelectorAll(".tab-content")
    ).forEach((e) => {
      e.classList.add("hidden");
    });
  }
  showTab(t) {
    if (!t) return console.error("Provided tab does not exist");
    this._hideAllTabs(),
      t.classList.add("tab-active"),
      this._showTabContent(t.dataset.relation),
      window.history.pushState({}, "", t.href);
  }
  _showTabContent(t) {
    const e = document.getElementById(t);
    if (!e) return console.error(`Provided tab (ID: ${t}) does not exist`);
    this._hideAllTabsContents(), e.classList.remove("hidden");
  }
}
class v {
  toggleChecked(t) {
    t.hasAttribute("checked")
      ? t.removeAttribute("checked")
      : t.setAttribute("checked", "");
  }
  revealElement(t) {
    const e = document.getElementById(t.dataset.elementid);
    t.hasAttribute("checked")
      ? e.classList.remove("hidden")
      : e.classList.add("hidden");
  }
  resetToggle(t) {
    t.click();
  }
  resetToggles(t) {
    const e = document.getElementById(t);
    if (!e) return console.error("Toggle container is not found");
    e.querySelectorAll("input[type='checkbox']").forEach((i) => {
      i.hasAttribute("checked") && i.click();
    });
  }
}
class C {
  constructor() {
    (this.alertView = new f()),
      (this.formView = new p("wpti-admin-form", "form-submit-btn")),
      (this.tabsView = new b("tabs-button-wrapper", "tabs-content-wrapper")),
      (this.toggleView = new v()),
      (this.fieldView = new g()),
      this._addControllers();
  }
  _addControllers() {
    this.formView.addClickHandler(this._controlClicks.bind(this)),
      this.formView.addChangeHandler(this._controlChange.bind(this)),
      this.formView.addInputHandler(this._controlInput.bind(this)),
      this.formView.addPasteHandler(this._controlPaste.bind(this)),
      this.formView.addFocusOutHandler(this._controlFocusOut.bind(this));
  }
  _removeLastCharacter(t) {
    return t.slice(0, t.length - 1);
  }
  _createMultiplePageIdItems(t) {
    return t.includes(",")
      ? t
          .split(",")
          .map((e) => e.trim())
          .filter((e) => e)
      : [t];
  }
  _showMultiplePageIds(t) {
    const e = t.value;
    if (this._validatePageIDs(t)) {
      t.value = this._removeLastCharacter(e);
      return;
    }
    const s = this._createMultiplePageIdItems(t.value);
    this.fieldView.showMultipleItems(s, t.dataset.displayid);
  }
  _sanitizeCSSSelectorInput(t) {
    let e = t.value;
    const s = t.selectionStart;
    if (e) {
      if ((e.length > 0 && !/^[#.]/.test(e) && (e = ""), e.length > 1)) {
        const i = e[0],
          o = e.substring(1).replace(/[^a-zA-Z0-9\-_]/g, "");
        e = i + o;
      }
      (t.value = e), t.setSelectionRange(s, s);
    }
  }
  _sanitizeCustomAttributesInput(t, e) {
    let s;
    e ? (s = e.clipboardData.getData("text")) : (s = t.value);
    let i = t.selectionStart,
      r = s.replace(/[^a-zA-Z0-9\-_:, ]/g, "");
    if (/^\s*,/.test(r)) {
      const a = r.length;
      (r = r.replace(/^\s*,/, "")), (i -= a - r.length);
    }
    const o = /([^,:\s])\s+([^,:\s])/g;
    if ((o.test(r) && ((r = r.replace(o, "$1, $2")), i++), r.endsWith(","))) {
      const a = r.slice(0, -1),
        n = a.lastIndexOf(",");
      a.substring(n + 1).includes(":") || (r = r.slice(0, -1));
    }
    (r = r.replace(/,{2,}/g, ",").replace(/:{2,}/g, ":")),
      (t.value = r),
      t.setSelectionRange(Math.max(0, i), Math.max(0, i));
  }
  _validatePageIDs(t) {
    const e = t.value.trim();
    let s,
      i = !1;
    return (
      /\d\s+\d/.test(e) && (s = "Cannot contain spaces without a separator"),
      /,,/.test(e) &&
        (s = "Contain 2 commas together without a value in middle"),
      /^\d+(,\s*\d+)*,?$/.test(e) || (s = "Contains invalid characters"),
      s && (this.alertView.showAlert(s, "error"), (i = !0)),
      i
    );
  }
  _validateCSSSelector(t) {
    const e = t.value.trim();
    if (!e) return;
    let s = !1;
    return (
      /^[#\.][a-zA-Z0-9\-_]+$/.test(e) ||
        ((t.value = ""),
        this.alertView.showAlert(
          "Selector must start with # or . and have a valid name (e.g., #my-id or .my-class)",
          "error"
        ),
        (s = !0)),
      s
    );
  }
  _validateWidgetDelay(t) {
    const e = u,
      s = m;
    let i = parseFloat(t.value),
      r = !1;
    if (!isNaN(i))
      return (
        i < e
          ? ((t.value = e),
            this.alertView.showAlert(
              `Provided value (${i}} is lesser than minimum value (${e})`
            ),
            (r = !0))
          : i > s &&
            ((t.value = s),
            this.alertView.showAlert(
              `Provided value (${i}} is greater than minimum value (${e})`
            ),
            (r = !0)),
        r
      );
  }
  _validateCustomAttributes(t) {
    const e = t.value.trim();
    if (!e) return;
    const s = e.split(",");
    let i = !1;
    for (const r of s) {
      const o = r.trim();
      if (o === "") {
        i = !0;
        break;
      }
      const a = o.split(":");
      if (a.length !== 2 || !a[0].trim() || !a[1].trim()) {
        i = !0;
        break;
      }
    }
    return (
      i
        ? (this.alertView.showAlert(
            'Invalid format. Use "key:value" pairs, separated by commas (e.g., name:John, plan:pro).',
            "error"
          ),
          (t.value = ""))
        : ((t.style.borderColor = ""), t.classList.add("border-green-500")),
      i
    );
  }
  setCurrentTab() {
    const t = new URL(window.location.href),
      e = new URLSearchParams(t.search),
      s =
        document.getElementById(e.get("tab")) ||
        document.getElementById("integration");
    this.tabsView.showTab(s);
  }
  _controlClicks(t) {
    const e = t.target.closest("button") || t.target.closest(".tab-btn");
    e &&
      (e.classList.contains("tab-btn") &&
        (t.preventDefault(), this.tabsView.showTab(e)),
      e.dataset.role === "reset" &&
        this.toggleView.resetToggles(e.dataset.itemscontainer),
      e.dataset.role === "clear" &&
        this.fieldView.clearField(e.dataset.elementid));
  }
  _controlChange(t) {
    const e = t.target,
      s = e.closest("input[role='switch']");
    e.closest("input[type='text']"),
      s &&
        (this.toggleView.toggleChecked(s),
        s.dataset.role === "reveal" && this.toggleView.revealElement(s));
  }
  _controlInput(t) {
    const e = t.target;
    (e.id === "hide-on-pages-input" ||
      e.id === "pages-to-ignore-tagging-input") &&
      this._validatePageIDs(e) &&
      this._showMultiplePageIds(e),
      e.id === "element-to-trigger-widget-when-clicked" &&
        this._validateCSSSelector(e),
      e.id === "custom-attributes-input" &&
        this._sanitizeCustomAttributesInput(e),
      e.id === "delay-widget-display" && this._validateWidgetDelay(e);
  }
  _controlFocusOut(t) {
    const e = t.target;
    if (!e.getAttribute("type") !== "text") {
      if (e.dataset.role === "tawk-api-key-input" && !e.value) {
        const s = document.getElementById(e.dataset.toggleid);
        return this.toggleView.resetToggle(s);
      }
      e.dataset.role === "input-selector" && this._validateCSSSelector(e),
        e.id === "custom-attributes-input" && this._validateCustomAttributes(e),
        (e.id === "hide-on-pages-input" ||
          e.id === "pages-to-ignore-tagging-input") &&
          this._validatePageIDs(e) &&
          this._showMultiplePageIds(e),
        e.id === "element-to-trigger-widget-when-clicked" &&
          this._validateCSSSelector(e);
    }
  }
  _controlPaste(t) {
    const e = t.target;
    t.clipboardData.getData("text"),
      e.id === "hide-on-pages-input" &&
        (this._validatePageIDs()
          ? t.preventDefault()
          : this.alertView.showAlert("Value pasted successfully")),
      e.id === "custom-attributes-input" &&
        (this._sanitizeCustomAttributesInput(e, t),
        this._validateCustomAttributes() && t.preventDefault());
  }
  _controlSubmit(t) {
    if ((t.preventDefault(), t.submitter !== this.formView.formSubmitter))
      return (
        console.log(t.submitter),
        console.log(this.formView.formSubmitter),
        this.alertView.showAlert(
          "Event submitter is not same as submit button",
          "error"
        )
      );
  }
  _controlFormData(t) {
    const e = t.formData;
    for (const [s, i] of e.entries())
      i && console.log(`Key: ${s}, Value: ${i}`);
  }
}
window.addEventListener("load", function () {
  new C().setCurrentTab();
});
